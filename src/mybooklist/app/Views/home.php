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
    <?= view('styles') ?>
</head>
<body>
<?= view('navbar') ?>

<!-- Title in the center -->
<h1 class="text-center my-5">Find Your Books</h1>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>