<?php
    session_start();
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    exit;
    }

    /* ===== ADD LINK ===== */
    if (isset($_POST['add'])) {

    $title = mysqli_real_escape_string($con, trim($_POST['title']));
    $url   = mysqli_real_escape_string($con, trim($_POST['url']));

    // basic validation
    if (! filter_var($url, FILTER_VALIDATE_URL)) {
        echo "<script>alert('Invalid URL format');</script>";
    } else {
        mysqli_query($con, "INSERT INTO quick_links(title,url)
        VALUES('$title','$url')");

        echo "<script>alert('Link Added Successfully');</script>";
        echo "<script>window.location='quicklinks.php';</script>";
    }
    }

    /* ===== DELETE LINK ===== */
    if (isset($_GET['delid'])) {
    $id = intval($_GET['delid']);

    mysqli_query($con, "DELETE FROM quick_links WHERE id='$id'");

    echo "<script>alert('Deleted Successfully');</script>";
    echo "<script>window.location='quicklinks.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>Quick Links Management</title>

<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">

<style>
.link-card {
    border-left: 5px solid #1cc88a;
    padding: 15px;
    border-radius: 10px;
    background: #f8fff9;
    margin-bottom: 15px;
    transition: 0.3s;
}
.link-card:hover {
    transform: translateY(-3px);
}
</style>

</head>

<body id="page-top">

<div id="wrapper">

<?php include_once 'includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
<div id="content">

<?php include_once 'includes/header.php'; ?>

<div class="container-fluid">

<h3 class="mb-4 text-gray-800">Manage Quick Links</h3>

<!-- 🔥 ADD LINK -->
<div class="card shadow mb-4">
<div class="card-header bg-success text-white">
<i class="fas fa-link"></i> Add Quick Link
</div>

<div class="card-body">

<form method="POST">

<div class="form-group">
<label>Link Title</label>
<input type="text" name="title" class="form-control" placeholder="Enter title" required>
</div>

<div class="form-group">
<label>URL</label>
<input type="text" name="url" class="form-control" placeholder="https://example.com" required>
</div>

<button type="submit" name="add" class="btn btn-success">
<i class="fas fa-plus"></i> Add Link
</button>

</form>

</div>
</div>

<!-- 🔗 VIEW LINKS -->
<div class="card shadow mb-4">
<div class="card-header bg-primary text-white">
<i class="fas fa-list"></i> All Quick Links
</div>

<div class="card-body">

<?php
    $query = mysqli_query($con, "SELECT * FROM quick_links ORDER BY id DESC");

    if (mysqli_num_rows($query) == 0) {
    echo "<p>No quick links available</p>";
    }

    while ($row = mysqli_fetch_assoc($query)) {
    ?>

<div class="link-card">

<h5><?php echo htmlspecialchars($row['title']); ?></h5>

<p>
<a href="<?php echo htmlspecialchars($row['url']); ?>" target="_blank">
<?php echo htmlspecialchars($row['url']); ?>
</a>
</p>

<small class="text-muted">
Added on: <?php echo $row['created_at']; ?>
</small>

<br><br>

<a href="quicklinks.php?delid=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this link?')">
<i class="fas fa-trash"></i> Delete
</a>

</div>

<?php }?>

</div>
</div>

</div>
</div>

<?php include_once 'includes/footer.php'; ?>

</div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../js/sb-admin-2.min.js"></script>

</body>
</html>