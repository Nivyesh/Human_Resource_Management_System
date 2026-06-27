<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HRMS | Human Resource Management System</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body{
    font-family: 'Poppins', sans-serif;
    background: #f4f6f9;
    margin:0;
}

/* Hero Section */
.hero{
    height:90vh;
    background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),
    url('https://images.unsplash.com/photo-1551836022-d5d88e9218df');
    background-size: cover;
    background-position: center;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    text-align:center;
    margin-top: 86px;
}
.hero h1{
    font-size:50px;
    font-weight:700;
}
.hero p{
    font-size:20px;
    margin-top:15px;
}
.hero button{
    padding:12px 30px;
    border:none;
    margin:10px;
    border-radius:30px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}
.btn-primary{
    background:#4e73df;
    color:white;
}
.btn-primary:hover{
    background:#2e59d9;
}
.btn-light{
    background:white;
    color:black;
}

/* Cards */
.section{
    padding:60px 10%;
}
.card-container{
    display:flex;
    gap:30px;
    flex-wrap:wrap;
    justify-content:center;
}
.card{
    background:white;
    padding:40px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
    text-align:center;
    width:300px;
    transition:0.3s;
}
.card:hover{
    transform:translateY(-10px);
}
.card i{
    font-size:40px;
    margin-bottom:20px;
    color:#4e73df;
}

/* Stats */
.stats{
    background:#4e73df;
    color:white;
    padding:60px 10%;
    display:flex;
    justify-content:space-around;
    text-align:center;
}
.stats h2{
    font-size:40px;
}

/* Footer */
.footer{
    background:#222;
    color:white;
    text-align:center;
    padding:20px;
}
html{
    scroll-behavior: smooth;
}
</style>
</head>
<body>

<!-- Hero Section -->
 <?php include 'navbar.php'; ?>
<div class="hero" id="home">
    <div>
        <h1>Human Resource Management System</h1>
        <p>Automate Payroll • Track Attendance • Manage Employees • Improve Productivity</p>
        <a href="loginerms.php"><button class="btn-primary">User Login</button></a>
        <a href="registererms.php"><button class="btn-light">Register</button></a>
        <a href="admin/"><button class="btn-primary">Admin Panel</button></a>
    </div>
</div>

<!-- Features -->
<div class="section" id="feature">
    <h2 style="text-align:center;margin-bottom:40px;">Core HRMS Features</h2>
    <div class="card-container">

        <div class="card">
            <i class="fas fa-users"></i>
            <h3>Employee Management</h3>
            <p>Manage employee records, departments and profiles efficiently.</p>
        </div>

        <div class="card">
            <i class="fas fa-calendar-check"></i>
            <h3>Attendance Tracking</h3>
            <p>Track daily attendance and generate monthly reports instantly.</p>
        </div>

        <div class="card">
            <i class="fas fa-money-bill-wave"></i>
            <h3>Payroll System</h3>
            <p>Automated salary calculation, deductions and payslip generation.</p>
        </div>

        <div class="card">
            <i class="fas fa-chart-line"></i>
            <h3>Performance Analytics</h3>
            <p>Monitor employee productivity using smart dashboards.</p>
        </div>

    </div>
</div>

<!-- Statistics Section -->
<div class="stats" id="about">
    <div>
        <h2>500+</h2>
        <p>Employees Managed</p>
    </div>
    <div>
        <h2>50+</h2>
        <p>Departments</p>
    </div>
    <div>
        <h2>99%</h2>
        <p>System Accuracy</p>
    </div>
</div>

<!-- About Section -->
<div class="section" id="">
    <h2 style="text-align:center;margin-bottom:40px;">Why Choose Our HRMS?</h2>
    <p style="text-align:center; max-width:800px; margin:auto;">
        Our Human Resource Management System helps organizations streamline HR processes,
        improve employee engagement, automate payroll, and ensure data security.
        Designed for modern enterprises, startups, and growing businesses.
    </p>
</div>
<section id="contact" style="padding:60px; background:#f8f9fc;">
    <h2 style="color:#4e73df;">Contact HRMS</h2>

    <p><strong>Address:</strong> 4th Floor,Anudisha,KAPS,Surat, Gujarat – 39XXXX</p>
    <p><strong>Phone:</strong> +91 98765 XXXXX</p>
    <p><strong>Email:</strong>hrsupport@hrms.com</p>
    <p><strong>Working Hours:</strong> Mon – Sat (9:00 AM – 6:00 PM)</p>
</section>

<!-- Footer -->
<div class="footer">
    © <?php echo date("Y"); ?> HRMS System | Developed for Enterprise Workforce Management
</div>

</body>
</html>