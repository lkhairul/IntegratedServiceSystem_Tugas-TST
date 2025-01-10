<!DOCTYPE html>
<html>
<head>
    <title>Book Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-title {
            text-transform: capitalize;
        }
    </style>
</head>
<body>
<?= view('navbar') ?>

<div class="container mt-5">
    <h2>Book Catalog</h2>

    <!-- Search bar and filter button -->
    <div class="d-flex justify-content-center mb-5">
        <form action="/book_catalog" method="get" class="w-50 d-flex">
            <input type="text" name="q" class="form-control" placeholder="Search by title" value="<?= esc($q ?? '') ?>">
            <button type="submit" class="btn btn-primary ms-2">Search</button>
        </form>
    </div>

    <div class="d-flex justify-content-center mb-5">
        <form action="/book_catalog" method="get" class="w-50 d-flex">
            <select name="genre" class="form-control">
                <option value="">Select Genre</option>
                <?php
                $genresList = [
                    'fiction', 'classics', '20th-century', 'non-fiction', 'history', 'literature', 'historical-fiction', 'historical',
                    'novels', 'romance', 'short-stories', 'biography', 'adventure', 'fantasy', 'literary-fiction', 'american', 'adult',
                    'philosophy', 'school', 'mystery'
                ];
                foreach ($genresList as $g) {
                    echo '<option value="' . esc($g) . '"' . ($genre == $g ? ' selected' : '') . '>' . esc($g) . '</option>';
                }
                ?>
            </select>
            <button type="submit" class="btn btn-secondary ms-2">Filter</button>
        </form>
    </div>

    <!-- Book List -->
    <div class="row">
        <?php if (!empty($books) && is_array($books)): ?>
            <?php foreach ($books as $book): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="public/book_template.png" class="card-img-top" alt="Book Cover">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc(ucwords($book['title'])) ?></h5>
                        <p class="card-text"><?= esc(implode(', ', json_decode($book['genres'], true))) ?></p>
                        <a href="/book/<?= esc($book['book_id']) ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    No books found
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>