<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h2>Profile</h2>
    <form action="/profile/update" method="post">
        <?= csrf_field() ?>
        <label>Username</label>
        <input type="text" name="username" value="<?= $user['username'] ?>" required>
        <br>
        <label>New Password</label>
        <input type="password" name="password">
        <br>
        <label>Confirm Password</label>
        <input type="password" name="password_confirm">
        <br>
        <label>Latitude</label>
        <input type="text" name="latitude" value="<?= $user['latitude'] ?>">
        <br>
        <label>Longitude</label>
        <input type="text" name="longitude" value="<?= $user['longitude'] ?>">
        <br>
        <button type="submit">Update</button>
    </form>
    <?php if (isset($validation)): ?>
        <div>
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>
</body>
</html>