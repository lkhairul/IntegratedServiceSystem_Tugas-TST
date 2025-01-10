<!DOCTYPE html>
<html>
<head>
    <title>Book Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-details-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
        }

        .book-title {
            color: #2c3e50;
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .book-info {
            color: #34495e;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .book-info strong {
            color: #2c3e50;
            font-weight: 600;
            margin-right: 10px;
        }

        .libraries-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .libraries-list li {
            padding: 12px 15px;
            margin-bottom: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .libraries-list li:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .action-buttons {
            margin-top: 25px;
        }

        .action-buttons .btn {
            padding: 10px 20px;
            margin-right: 10px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .action-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .genres-tags {
            margin: 15px 0;
        }

        .genre-tag {
            display: inline-block;
            background: #e9ecef;
            padding: 5px 12px;
            border-radius: 15px;
            margin-right: 8px;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: #495057;
        }
    </style>
</head>
<body>
    <?= view('navbar') ?>
    <div class="container">
        <div class="book-details-card">
            <h2 class="book-title"><?= esc($book['title']) ?></h2>
            
            <div class="book-info">
                <strong>Book ID:</strong> <?= esc($book['book_id']) ?>
            </div>

            <div class="genres-tags">
                <strong>Genres:</strong><br>
                <?php foreach (json_decode($book['genres'], true) as $genre): ?>
                    <span class="genre-tag"><?= esc($genre) ?></span>
                <?php endforeach; ?>
            </div>

            <div class="book-info">
                <strong>Perpus yang tersedia:</strong>
                <ul class="libraries-list">
                    <?php foreach ($libraries as $library): ?>
                        <li><?= esc($library['name']) ?> - <?= esc(number_format($library['distance'], 2)) ?> km from your location</li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="action-buttons">
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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>