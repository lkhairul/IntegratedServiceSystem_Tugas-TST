<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h2>Profile</h2>

    <!-- User Data Segment -->
    <div>
        <h3>User Data</h3>
        <p><strong>Username:</strong> <?= $user['username'] ?></p>
        <p><strong>Email:</strong> <?= $user['email'] ?></p>
        <p><strong>Latitude:</strong> <?= $user['latitude'] ?></p>
        <p><strong>Longitude:</strong> <?= $user['longitude'] ?></p>
    </div>
    
    <!-- Update Data Segment -->
    <div>
        <h3>Update Data</h3>
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
            <input type="text" name="latitude" value="<?= $user['latitude'] !== null ? $user['latitude'] : '' ?>" required>
            <br>
            <label>Longitude</label>
            <input type="text" name="longitude" value="<?= $user['longitude'] !== null ? $user['longitude'] : '' ?>" required>
            <br>
            <button type="submit">Update</button>
        </form>
    </div>
    
    <?php if (isset($validation)): ?>
        <div>
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>
</body>
</html>
