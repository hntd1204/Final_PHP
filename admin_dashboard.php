<?php
session_start();
require 'database.php';

if ($_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit();
}

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $search = mysqli_real_escape_string($conn, $search);
}

$sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm - Admin</title>
    <link rel="stylesheet" href="style.css">
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
                <a href="logout.php" class="btn btn-outline-light">Đăng Xuất</a>
            </ul>
        </nav>
    </header>

    <main class="container mt-5">
        <h2 class="text-center">Quản lý sản phẩm</h2>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="add_product.php" class="btn btn-primary">Thêm sản phẩm mới</a>

            <form action="admin_dashboard.php" method="GET" class="d-flex" style="max-width: 300px;">
                <input type="text" class="form-control" name="search" placeholder="Tìm sản phẩm..."
                    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" style="border-radius: 20px;">
                <button type="submit" class="btn btn-primary ms-2" style="border-radius: 20px;"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <?php if ($result->num_rows == 0): ?>
            <div class="alert alert-info text-center">Không tìm thấy sản phẩm khớp với từ khóa "<?php echo $search; ?>"
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá size nhỏ</th>
                    <th>Giá size lớn</th>
                    <th>Hình ảnh</th>
                    <th>Ghi chú</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo number_format($row['size_small_price'], 0); ?> VND</td>
                        <td><?php echo number_format($row['size_large_price'], 0); ?> VND</td>
                        <td><img src="<?php echo $row['image']; ?>" width="50" height="50" alt="image"></td>
                        <td><?php echo $row['notes']; ?></td>
                        <td>
                            <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Sửa</a>
                            <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"
                                onclick="return confirm('Bạn chắc chắn muốn xoá sản phẩm này?')">Xoá</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-secondary">Quay lại trang chủ</a>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>