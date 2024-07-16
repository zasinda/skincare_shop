<!-- views/login.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; font-size: 16px; }
        .error { color: red; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="error"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
        <?= form_open('auth/login'); ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= set_value('username'); ?>" autofocus>
                <div class="error"><?= form_error('username'); ?></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <div class="error"><?= form_error('password'); ?></div>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        <?= form_close(); ?>
        <div class="register-link">
            Belum punya akun? <a href="<?= base_url('auth/register'); ?>">Daftar</a>
        </div>
    </div>
</body>
</html>
