<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <style>
        /* Navbar */
.navbar{
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 15px 8%;
    backdrop-filter: blur(10px);
    background: #4e73df;
    z-index: 1000;

}

.logo{
    color:white;
    font-size:22px;
    font-weight:700;
}

.nav-links{
    list-style:none;
    display:flex;
    gap:30px;
}

.nav-links li a{
    color:white;
    text-decoration:none;
    font-weight:500;
    transition:0.3s;
}

.nav-links li a:hover{
    color:#4e73df;
    background-color: white;
    border: 2px solid white;
    border-radius: 2px;
}

.nav-buttons a{
    padding:8px 18px;
    border-radius:25px;
    margin-left:10px;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
    transition:0.3s;
}

.btn-outline{
    border:2px solid white;
    color:white;
}

.btn-outline:hover{
    background:white;
    color:black;
}

.btn-light-nav{
    background:white;
    color:black;
}

.btn-primary-nav{
    background:#4e73df;
    color:white;
}

.btn-primary-nav:hover{
    background:#2e59d9;
}

.menu-toggle{
    display:none;
    color:white;
    font-size:22px;
    cursor:pointer;
}

/* Mobile Responsive */
@media(max-width:992px){
    .nav-links,
    .nav-buttons{
        display:none;
    }
    .menu-toggle{
        display:block;
    }
}
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar">
    <div class="logo">
        <i class="fas fa-building"></i> HRMS
    </div>

    <ul class="nav-links">
        <li><a href="../#home">Home</a></li>
        <li><a href="../#feature">Features</a></li>
        <li><a href="../#about">About</a></li>
        <li><a href="../#contact">Contact</a></li>
    </ul>

    <div class="nav-buttons">
        <a href="../loginerms.php" class="btn-outline">Login</a>
        <a href="../registererms.php" class="btn-light-nav">Register</a>
        <a href="index.php" class="btn-primary-nav">Admin</a>
    </div>

    <div class="menu-toggle">
        <i class="fas fa-bars"></i>
    </div>
</nav>
</body>
</html>
