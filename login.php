<?php
session_start();
require 'database.php';

$error = "";

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["user"] = $row["name"];
            header("Location: index.php");
            exit();
        } else {
            $error = "Mật khẩu không đúng!";
        }
    } else {
        $error = "Email không tồn tại!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Chatte Milk Tea & Coffee</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="logo">
            <img src="./hinhanh/Logo.png" alt="Logo Chatte">
            <span>Chatte Milk Tea & Coffee</span>
        </div>
    </header>

    <main class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="card p-4 shadow login-box">
            <h2 class="text-center text-brown">Đăng Nhập</h2>

            <?php if ($error): ?>
            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="process_login.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Nhập mật khẩu" required>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="forgot_password.php" class="text-brown">Quên mật khẩu?</a>
                </div>
                <button type="submit" class="btn btn-brown w-100">Đăng Nhập</button>
            </form>

            <div class="text-center mt-3">
                <p>Chưa có tài khoản? <a href="register.php" class="text-brown">Đăng ký ngay</a></p>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>