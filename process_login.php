<?php
session_start();
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        $_SESSION["error"] = "Vui lòng nhập đầy đủ email và mật khẩu!";
        header("Location: login.php");
        exit();
    }

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["user"] = $row["name"];
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["role"] = $row["role"];

            header("Location: index.php");
            exit();
        } else {
            $_SESSION["error"] = "Mật khẩu không đúng!";
        }
    } else {
        $_SESSION["error"] = "Email không tồn tại!";
    }

    header("Location: login.php");
    exit();
}
