<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-title {
            text-transform: capitalize;
        }
    </style>
</head>
<body>
<?= view('navbar') ?>

<!-- Title in the center -->
<h1 class="text-center my-5">Book Recommender</h1>

<!-- Search bar -->
<div class="d-flex justify-content-center mb-5">
    <form action="/book_catalog" method="get" class="w-50 d-flex">
        <input type="text" name="q" class="form-control" placeholder="Start Searching for Your Books">
        <button type="submit" class="btn btn-primary ms-2">Search</button>
    </form>
</div>

<!-- Recommender Section -->
<?php if (!empty($recommendedBooks)): ?>
<div class="container mb-5">
    <h3>Recommended for You</h3>
    <div class="row">
        <?php foreach ($recommendedBooks as $recBook): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="/public/book_template.png" class="card-img-top" alt="Book Cover">
                <div class="card-body">
                    <h5 class="card-title"><?= esc(ucwords($recBook['title'])) ?></h5>
                    <p class="card-text"><?= esc(implode(', ', json_decode($recBook['genres'], true))) ?></p>
                    <a href="/book/<?= esc($recBook['book_id']) ?>" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- Existing Book List -->
<div class="container">
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php if (!empty($books) && is_array($books)): ?>
            <?php foreach ($books as $book): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="/public/book_template.png" class="card-img-top" alt="Book Cover">
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