<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
    <style>
        .history-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>

<h1>Book List</h1>

<!-- Tombol Navigasi ke Halaman History di Pojok Kanan Atas -->
<div class="history-button">
    <button onclick="window.location.href='/books/history'">History</button>
</div>

<form action="/books/search" method="post">
    <input type="text" name="search" placeholder="Search books...">
    <button type="submit">Search</button>
</form>

<button onclick="showFilter()">Filter</button>
<button onclick="sortBooks()">Sort</button>

<div id="filterOptions" style="display:none;">
    <form action="/books/filter" method="post">
        <input type="text" name="genres" placeholder="Enter genres...">
        <button type="submit">Filter</button>
    </form>
</div>

<table>
    <tr>
        <th>Title</th>
        <th>Genres</th>
        <th>Action</th>
    </tr>
    <?php foreach ($books as $book): ?>
        <tr>
            <td><?= $book['title'] ?></td>
            <td><?= $book['genres'] ?></td>
            <td>
                <form action="/books/updateStatus" method="post">
                    <input type="hidden" name="bookID" value="<?= $book['book_id'] ?>">
                    <select name="status">
                        <option value="-">-</option>
                        <option value="wishlist">Wishlist</option>
                        <option value="on-read">On-read</option>
                        <option value="completed">Completed</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
function showFilter() {
    var x = document.getElementById("filterOptions");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function sortBooks() {
    // Anda dapat mengimplementasikan logika pengurutan di sini
}
</script>

</body>
</html>
