<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="/auth/register" method="post">
        <?= csrf_field() ?>
        <label>Email</label>
        <input type="email" name="email" required>
        <br>
        <label>Username</label>
        <input type="text" name="username" required>
        <br>
        <label>Password</label>
        <input type="password" name="password" required>
        <br>
        <label>Confirm Password</label>
        <input type="password" name="password_confirm" required>
        <br>
        <button type="submit">Register</button>
    </form>
    <?php if (isset($validation)): ?>
        <div>
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>
</body>
</html>