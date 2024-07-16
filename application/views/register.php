<!-- views/register.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 500px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; font-size: 16px; }
        .error { color: red; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?= form_open('auth/register'); ?>
            <div class="form-group">
                <label for="nama_lengkap">Full Name</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= set_value('nama_lengkap'); ?>" autofocus>
                <div class="error"><?= form_error('nama_lengkap'); ?></div>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= set_value('username'); ?>">
                <div class="error"><?= form_error('username'); ?></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <div class="error"><?= form_error('password'); ?></div>
            </div>
            <div class="form-group">
                <label for="email_user">Email</label>
                <input type="email" id="email_user" name="email_user" value="<?= set_value('email_user'); ?>">
                <div class="error"><?= form_error('email_user'); ?></div>
            </div>
            <div class="form-group">
                <label for="alamat_user">Address</label>
                <input type="text" id="alamat_user" name="alamat_user" value="<?= set_value('alamat_user'); ?>">
                <div class="error"><?= form_error('alamat_user'); ?></div>
            </div>
            <div class="form-group">
                <label for="nohp_user">Phone Number</label>
                <input type="text" id="nohp_user" name="nohp_user" value="<?= set_value('nohp_user'); ?>">
                <div class="error"><?= form_error('nohp_user'); ?></div>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        <?= form_close(); ?>
        <div class="login-link">
            Sudah punya akun? <a href="<?= base_url('auth/login'); ?>">Login</a>
        </div>
    </div>
</body>
</html>
