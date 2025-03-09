<?php
session_start();
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $role = isset($_POST["role"]) && $_POST["role"] === "admin" ? "admin" : "user";

    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION["error"] = "Vui lòng nhập đầy đủ thông tin!";
        header("Location: register.php");
        exit();
    }

    $check_query = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION["error"] = "Email đã được sử dụng!";
        header("Location: register.php");
        exit();
    }

    // Hash mật khẩu
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION["success"] = "Đăng ký thành công! Vui lòng đăng nhập.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION["error"] = "Có lỗi xảy ra! Vui lòng thử lại.";
        header("Location: register.php");
        exit();
    }
}
