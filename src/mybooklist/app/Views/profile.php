<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeXm3YXa_04U5RDT0SHbDvLZNeNzwCavc"></script>
    <script>
        function initMap() {
            var initialLatLng = { lat: <?= $user['latitude'] ?? -6.200000 ?>, lng: <?= $user['longitude'] ?? 106.816666 ?> };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: initialLatLng
            });

            var marker = new google.maps.Marker({
                position: initialLatLng,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });
        }
    </script>
</head>
<body onload="initMap()">
    <?= view('navbar') ?>
    <div class="container mt-5">
        <h2>Profile</h2>
        <a href="/auth/logout" class="btn btn-danger mb-3">Logout</a>

        <!-- User Data Segment -->
        <div class="card mb-3">
            <div class="card-header">
                User Data
            </div>
            <div class="card-body">
                <p><strong>Username:</strong> <?= $user['username'] ?></p>
                <p><strong>Email:</strong> <?= $user['email'] ?></p>
                <p><strong>Latitude:</strong> <?= $user['latitude'] ?></p>
                <p><strong>Longitude:</strong> <?= $user['longitude'] ?></p>
            </div>
        </div>
        
        <!-- Update Username Segment -->
        <div class="card mb-3">
            <div class="card-header">
                Update Username
            </div>
            <div class="card-body">
                <form action="/profile/updateUsername" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Username</button>
                </form>
            </div>
        </div>

        <!-- Update Password Segment -->
        <div class="card mb-3">
            <div class="card-header">
                Update Password
            </div>
            <div class="card-body">
                <form action="/profile/updatePassword" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirm" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>

        <!-- Update Location Segment -->
        <div class="card mb-3">
            <div class="card-header">
                Update Location
            </div>
            <div class="card-body">
                <div id="map" style="height: 400px; width: 100%;"></div>
                <form action="/profile/updateLocation" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" id="latitude" name="latitude" value="<?= $user['latitude'] !== null ? $user['latitude'] : '' ?>" required>
                    <input type="hidden" id="longitude" name="longitude" value="<?= $user['longitude'] !== null ? $user['longitude'] : '' ?>" required>
                    <br>
                    <button type="submit" class="btn btn-primary mt-3">Update Location</button>
                </form>
            </div>
        </div>
        
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <?php if (session()->get('success')): ?>
            <div class="alert alert-success">
                <?= session()->get('success') ?>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
