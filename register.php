<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - Chatte Milk Tea & Coffee</title>
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
            <h2 class="text-center text-brown">Đăng Ký</h2>

            <?php if (isset($_SESSION["error"])): ?>
                <div class="alert alert-danger text-center"><?php echo $_SESSION["error"]; ?></div>
                <?php unset($_SESSION["error"]); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION["success"])): ?>
                <div class="alert alert-success text-center"><?php echo $_SESSION["success"]; ?></div>
                <?php unset($_SESSION["success"]); ?>
            <?php endif; ?>

            <form action="process_register.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Họ Tên:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nhập họ tên" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-brown w-100">Đăng Ký</button>
            </form>

            <div class="text-center mt-3">
                <p>Đã có tài khoản? <a href="login.php" class="text-brown">Đăng nhập ngay</a></p>
            </div>
            <button onclick="location.href='index.php'" class="btn btn-back w-100">Quay lại trang chủ</button>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>