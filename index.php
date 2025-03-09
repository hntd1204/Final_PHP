<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require 'database.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatte Milk Tea & Coffee</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="logo">
            <img src="./hinhanh/Logo.png" alt="Logo Chatte">
            <span>Chatte Milk Tea & Coffee</span>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">TRANG CHỦ</a></li>
                <li><a href="#">GIỚI THIỆU</a></li>
                <li><a href="#">SẢN PHẨM</a></li>
                <li><a href="#">KHUYẾN MÃI</a></li>
                <li><a href="#">LIÊN HỆ</a></li>
            </ul>
        </nav>
        <div class="d-flex">
            <?php if (isset($_SESSION['user'])): ?>
                <span class="me-3 text-white">Xin chào, <?php echo $_SESSION['user']; ?>!</span>
                <?php if ($_SESSION["role"] === "admin"): ?>
                    <a href="admin_dashboard.php" class="btn btn-danger me-2">Quản lý</a>
                <?php endif; ?>
                <a href="logout.php" class="btn btn-outline-light">Đăng Xuất</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-light me-2">Đăng Nhập</a>
            <?php endif; ?>
        </div>
    </header>
    <br>

    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./hinhanh/Menu1.jpg" class="d-block w-100" alt="Menu1"
                    style="height: 400px; object-fit: contain;">
            </div>
            <div class="carousel-item">
                <img src="./hinhanh/Menu2.jpg" class="d-block w-100" alt="Menu2"
                    style="height: 400px; object-fit: contain;">
            </div>
            <div class="carousel-item">
                <img src="./hinhanh/Carousel.png" class="d-block w-100" alt="Banner1"
                    style="height: 400px; object-fit: contain;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <main>
        <h1 class="text-center">SẢN PHẨM CỦA CHÚNG TỚ</h1>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="menu-category">
                        <h2>MENU</h2>
                        <ul>
                            <li><a href="#">COFFEE</a></li>
                            <li><a href="#">MILK TEA</a></li>
                            <li><a href="#">TEA</a></li>
                            <li><a href="#">ICE BLENDED</a></li>
                            <li><a href="#">SODA</a></li>
                            <li><a href="#">TOPPING</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <?php while ($product = $result->fetch_assoc()): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm">
                                    <img src="<?php echo $product['image']; ?>" class="card-img-top"
                                        alt="<?php echo $product['name']; ?>" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                        <p class="card-text">Giá size nhỏ:
                                            <?php echo number_format($product['size_small_price'], 0); ?> VND</p>
                                        <p class="card-text">Giá size lớn:
                                            <?php echo number_format($product['size_large_price'], 0); ?> VND</p>

                                        <div class="form-group">
                                            <label for="size">Chọn size:</label>
                                            <select class="form-select" id="size" name="size">
                                                <option value="large">Size Nhỏ</option>
                                                <option value="small">Size Lớn</option>
                                            </select>
                                        </div>

                                        <div class="d-flex justify-content-between mt-3">
                                            <button class="btn btn-outline-secondary">Thêm vào giỏ hàng</button>
                                            <button class="btn btn-primary">Mua ngay</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>