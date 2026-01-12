<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installer - Toko Produk Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .install-card { width: 100%; max-width: 500px; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); background: white; }
    </style>
</head>
<body>
    <div class="install-card">
        <h3 class="text-center mb-4">Installer Website</h3>
        <form id="installForm">
            <div class="mb-3">
                <label class="form-label">Database Host</label>
                <input type="text" name="host" class="form-control" value="localhost" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Database User</label>
                <input type="text" name="user" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Database Password</label>
                <input type="password" name="pass" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Database Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Base URL (Domain)</label>
                <input type="url" name="base_url" class="form-control" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Install Sekarang</button>
        </form>
        <div id="message" class="mt-3"></div>
    </div>

    <script>
        document.getElementById('installForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('button');
            const msg = document.getElementById('message');
            btn.disabled = true;
            btn.innerText = 'Installing...';
            msg.innerHTML = '';

            const formData = new FormData(this);

            fetch('process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                btn.disabled = false;
                btn.innerText = 'Install Sekarang';
                if (data.success) {
                    msg.innerHTML = `<div class="alert alert-success">${data.message}. Redirecting...</div>`;
                    setTimeout(() => window.location.href = '../index.php', 2000);
                } else {
                    msg.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerText = 'Install Sekarang';
                msg.innerHTML = `<div class="alert alert-danger">An error occurred: ${err}</div>`;
            });
        });
    </script>
</body>
</html>
