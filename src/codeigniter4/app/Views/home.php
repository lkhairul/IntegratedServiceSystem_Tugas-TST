<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h2>Book List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Genres</th>
                <th>Perpus</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($books) && is_array($books)): ?>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= esc($book['book_id']) ?></td>
                        <td><?= esc($book['title']) ?></td>
                        <td><?= esc($book['genres']) ?></td>
                        <td><?= esc($book['perpus']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No books found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>