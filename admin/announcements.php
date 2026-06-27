<?php
    session_start();
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    exit;
    }

    /* ===== ADD ANNOUNCEMENT ===== */
    if (isset($_POST['add'])) {

    $title = mysqli_real_escape_string($con, $_POST['title']);
    $msg   = mysqli_real_escape_string($con, $_POST['message']);

    mysqli_query($con, "INSERT INTO announcements(title,message)
    VALUES('$title','$msg')");

    echo "<script>alert('Announcement Posted');</script>";
    echo "<script>window.location='announcements.php';</script>";
    }

    /* ===== DELETE ===== */
    if (isset($_GET['delid'])) {

    $id = intval($_GET['delid']); // secure

    mysqli_query($con, "DELETE FROM announcements WHERE id='$id'");

    echo "<script>alert('Deleted Successfully');</script>";
    echo "<script>window.location='announcements.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>Announcements</title>

<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">

<style>
.announce-card {
    border-left: 5px solid #4e73df;
    padding: 15px;
    border-radius: 10px;
    background: #f8f9fc;
    margin-bottom: 15px;
    transition: 0.3s;
}
.announce-card:hover {
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

<h3 class="mb-4 text-gray-800">Manage Announcements</h3>

<!-- 🔥 ADD FORM -->
<div class="card shadow mb-4">
<div class="card-header bg-primary text-white">
<i class="fas fa-bullhorn"></i> Post Announcement
</div>

<div class="card-body">

<form method="POST">

<div class="form-group">
<label>Title</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="form-group">
<label>Message</label>
<textarea name="message" class="form-control" rows="4" required></textarea>
</div>

<button type="submit" name="add" class="btn btn-primary">
<i class="fas fa-plus"></i> Post Announcement
</button>

</form>

</div>
</div>

<!-- 📢 DISPLAY -->
<div class="card shadow mb-4">
<div class="card-header bg-success text-white">
<i class="fas fa-list"></i> All Announcements
</div>

<div class="card-body">

<?php
    $query = mysqli_query($con, "SELECT * FROM announcements ORDER BY id DESC");

    if (mysqli_num_rows($query) == 0) {
    echo "<p>No announcements found</p>";
    }

    while ($row = mysqli_fetch_assoc($query)) {
    ?>

<div class="announce-card">

<h5><?php echo htmlspecialchars($row['title']); ?></h5>

<p><?php echo htmlspecialchars($row['message']); ?></p>

<small class="text-muted">
Posted on: <?php echo $row['created_at']; ?>
</small>

<br><br>

<a href="announcements.php?delid=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this announcement?')">
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