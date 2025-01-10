<!DOCTYPE html>
<html>
<head>
    <title>Book Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-section {
            display: none;
        }
        .btn-group .btn.active {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
<?= view('navbar') ?>

<div class="container mt-5">
    <h2>Book Management</h2>

    <!-- Navigation Buttons -->
    <div class="btn-group mb-5" role="group">
        <button type="button" class="btn btn-primary" onclick="showSection('wishlist', this)">Wishlist</button>
        <button type="button" class="btn btn-primary" onclick="showSection('reading', this)">Currently Reading</button>
        <button type="button" class="btn btn-primary" onclick="showSection('completed', this)">Completed</button>
    </div>

    <!-- Wishlist Section -->
    <div id="wishlist" class="book-section">
        <h3>Wishlist</h3>
        <ul class="list-group">
            <?php if (!empty($wishlistBooks)): ?>
                <?php foreach ($wishlistBooks as $book): ?>
                <li class="list-group-item">
                    <a href="/book/<?= esc($book['book_id']) ?>"><?= esc(ucwords($book['title'])) ?></a>
                    <p><?= esc(implode(', ', json_decode($book['genres'], true))) ?></p>
                </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No books in wishlist</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Reading Section -->
    <div id="reading" class="book-section">
        <h3>Currently Reading</h3>
        <ul class="list-group">
            <?php if (!empty($readingBooks)): ?>
                <?php foreach ($readingBooks as $book): ?>
                <li class="list-group-item">
                    <a href="/book/<?= esc($book['book_id']) ?>"><?= esc(ucwords($book['title'])) ?></a>
                    <p><?= esc(implode(', ', json_decode($book['genres'], true))) ?></p>
                </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No books currently being read</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Completed Section -->
    <div id="completed" class="book-section">
        <h3>Completed</h3>
        <ul class="list-group">
            <?php if (!empty($completedBooks)): ?>
                <?php foreach ($completedBooks as $book): ?>
                <li class="list-group-item">
                    <a href="/book/<?= esc($book['book_id']) ?>"><?= esc(ucwords($book['title'])) ?></a>
                    <p><?= esc(implode(', ', json_decode($book['genres'], true))) ?></p>
                </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No books completed</li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<script>
    function showSection(sectionId, btn) {
        document.querySelectorAll('.book-section').forEach(section => {
            section.style.display = 'none';
        });
        document.getElementById(sectionId).style.display = 'block';

        document.querySelectorAll('.btn-group .btn').forEach(button => {
            button.classList.remove('active');
        });
        btn.classList.add('active');
    }

    // Show the wishlist section by default
    document.addEventListener('DOMContentLoaded', function() {
        showSection('wishlist', document.querySelector('.btn-group .btn'));
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>