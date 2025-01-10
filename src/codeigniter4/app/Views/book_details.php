<!DOCTYPE html>
<html>
<head>
    <title>Book Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?= view('navbar') ?>
    <div class="container mt-4">
        <h2>Book Details</h2>
        <p><strong>Book ID:</strong> <?= esc($book['book_id']) ?></p>
        <p><strong>Title:</strong> <?= esc($book['title']) ?></p>
        <p><strong>Genres:</strong> <?= esc(implode(', ', json_decode($book['genres'], true))) ?></p>
        <p><strong>Perpus:</strong> <?= esc($book['perpus']) ?></p>

        <?php
            if (isset($user) && $user) {
                $wishlist  = !empty($user['wishlist'])  ? json_decode($user['wishlist'], true)   : [];
                $reading   = !empty($user['reading'])   ? json_decode($user['reading'], true)    : [];
                $completed = !empty($user['completed']) ? json_decode($user['completed'], true)  : [];

                $bookId = $book['book_id'];

                if (in_array($bookId, $completed)) {
                    echo '<button class="btn btn-secondary" disabled>Completed</button>';
                } elseif (in_array($bookId, $reading)) {
                    echo '<button class="btn btn-info" disabled>Currently Reading</button> ';
                    echo '<a href="/book/completeBook/' . esc($bookId) . '" class="btn btn-success">Complete</a>';
                } elseif (in_array($bookId, $wishlist)) {
                    echo '<a href="/book/startReading/' . esc($bookId) . '" class="btn btn-warning">Start Reading</a>';
                } else {
                    echo '<a href="/book/addWishlist/' . esc($bookId) . '" class="btn btn-primary">Wishlist</a>';
                }
            } else {
                echo '<a href="/auth/login" class="btn btn-primary">Login to manage books</a>';
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>