<?php
// install/sql_import.php
class SqlImport {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function import($sqlFile) {
        if (!file_exists($sqlFile)) {
            return false;
        }

        $query = file_get_contents($sqlFile);
        $stmt = $this->pdo->prepare($query);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            // In a real scenario, we might want to split queries if they are multiple statements
            // Standard PDO prepare/execute works for multiple statements if the driver supports it (MySQL usually does)
            // But sometimes we need to split by ';'

            // Fallback split
            $queries = explode(';', $query);
            foreach ($queries as $q) {
                $q = trim($q);
                if (!empty($q)) {
                    $this->pdo->exec($q);
                }
            }
            return true;
        }
    }
}
