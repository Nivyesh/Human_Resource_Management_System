<?php
    session_start();
    include 'includes/dbconnection.php';

    if (! isset($_SESSION['uid']) || $_SESSION['uid'] == 0) {
    header('location:logout.php');
    exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<title>Quick Links</title>

<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">

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
.link-card a {
    font-weight: bold;
    color: #1cc88a;
    text-decoration: none;
}
.link-card a:hover {
    text-decoration: underline;
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

<h3 class="mb-4 text-gray-800">Quick Links</h3>

<div class="card shadow">
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

</div>

<?php }?>

</div>
</div>

</div>
</div>

<?php include_once 'includes/footer.php'; ?>

</div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>