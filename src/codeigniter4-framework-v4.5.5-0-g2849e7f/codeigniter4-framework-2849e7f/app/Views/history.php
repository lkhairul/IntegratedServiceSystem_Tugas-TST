<!DOCTYPE html>
<html>
<head>
    <title>Book History</title>
</head>
<body>

<h1>Book History</h1>

<button onclick="window.location.href='/books/history/wishlist'">Wishlist</button>
<button onclick="window.location.href='/books/history/on-read'">On-read</button>
<button onclick="window.location.href='/books/history/completed'">Completed</button>

<table>
    <tr>
        <th>Title</th>
        <th>Status</th>
    </tr>
    <?php foreach ($books as $book): ?>
        <tr>
            <td><?= $book['title'] ?></td>
            <td><?= $book['status'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
