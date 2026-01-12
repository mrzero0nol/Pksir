<?php
require_once 'config.php';

try {
    echo "Starting migration...\n";

    // 1. Add username column if it doesn't exist
    try {
        $pdo->query("SELECT username FROM users LIMIT 1");
        echo "Column 'username' already exists.\n";
    } catch (PDOException $e) {
        echo "Adding column 'username'...\n";
        // Add as nullable first to avoid errors with existing data
        $pdo->exec("ALTER TABLE users ADD COLUMN username VARCHAR(50) AFTER id");
        // Update existing users to have username = email (temporary fix)
        $pdo->exec("UPDATE users SET username = SUBSTRING_INDEX(email, '@', 1) WHERE username IS NULL");
        // Now make it unique and not null
        $pdo->exec("ALTER TABLE users MODIFY COLUMN username VARCHAR(50) NOT NULL UNIQUE");
        echo "Column 'username' added successfully.\n";
    }

    // 2. Add role column if it doesn't exist
    try {
        $pdo->query("SELECT role FROM users LIMIT 1");
        echo "Column 'role' already exists.\n";
    } catch (PDOException $e) {
        echo "Adding column 'role'...\n";
        $pdo->exec("ALTER TABLE users ADD COLUMN role ENUM('user','admin') DEFAULT 'user' AFTER password");
        echo "Column 'role' added successfully.\n";
    }

    // 3. Migrate/Create Admin User
    $adminUsername = 'admin';
    // Hash for 'admin123'
    $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
    $adminEmail = 'admin@example.com';
    $adminName = 'Super Admin';

    // Check if admin exists in users
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$adminUsername]);
    $existingAdmin = $stmt->fetch();

    if (!$existingAdmin) {
        echo "Creating admin user in 'users' table...\n";
        $stmt = $pdo->prepare("INSERT INTO users (username, name, email, password, role) VALUES (?, ?, ?, ?, 'admin')");
        // We need a dummy email because email is likely UNIQUE and NOT NULL
        try {
            $stmt->execute([$adminUsername, $adminName, $adminEmail, $adminPassword]);
            echo "Admin user created successfully.\n";
        } catch (PDOException $e) {
            // If email conflict, try another one
             $stmt->execute([$adminUsername, $adminName, 'admin2@example.com', $adminPassword]);
             echo "Admin user created (with alt email).\n";
        }
    } else {
        echo "Admin user already exists. Updating role to 'admin'...\n";
        $stmt = $pdo->prepare("UPDATE users SET role = 'admin', password = ? WHERE username = ?");
        $stmt->execute([$adminPassword, $adminUsername]);
        echo "Admin role updated.\n";
    }

    echo "Migration completed successfully.\n";

} catch (PDOException $e) {
    die("Migration Failed: " . $e->getMessage());
}
