<?php
session_start();
require 'database.php';

if ($_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION["success"] = "Sản phẩm đã được xoá!";
    } else {
        $_SESSION["error"] = "Có lỗi xảy ra khi xoá sản phẩm.";
    }

    header("Location: admin_dashboard.php");
    exit();
}
