<?php
session_start();
require 'database.php';

if ($_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $size_large_price = $_POST["size_large_price"];
    $size_small_price = $_POST["size_small_price"];
    $image = $_POST["image"];
    $notes = $_POST["notes"];

    $query = "INSERT INTO products (name, size_large_price, size_small_price, image, notes) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sddss", $name, $size_large_price, $size_small_price, $image, $notes);

    if ($stmt->execute()) {
        $_SESSION["success"] = "Sản phẩm đã được thêm thành công!";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION["error"] = "Có lỗi xảy ra! Vui lòng thử lại.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="logo">
            <img src="./hinhanh/Logo.png" alt="Logo Chatte">
            <span>Chatte Milk Tea & Coffee</span>
        </div>
    </header>

    <main class="container mt-5">
        <h2 class="text-center">Thêm sản phẩm mới</h2>

        <form action="add_product.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label for="size_small_price" class="form-label">Giá size nhỏ:</label>
                <input type="number" class="form-control" name="size_small_price" required>
            </div>
            <div class="mb-3">
                <label for="size_large_price" class="form-label">Giá size lớn:</label>
                <input type="number" class="form-control" name="size_large_price" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh:</label>
                <input type="text" class="form-control" name="image" required>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Ghi chú:</label>
                <textarea class="form-control" name="notes"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Thêm sản phẩm</button>
        </form>
        <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Quay lại</a>
    </main>
</body>

</html>