<?php
session_start();
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio_Ciise</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
    <header class="site_header">
        <div class="main_logo">
            <h1>Portfolio <span><em>Ciise</em></span></h1>
        </div>
        <nav>
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <li><a href="admin/add_project.php">Projects</a></li>
            <li><a href="#">Contact</a></li>
            <?php 
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <a href="auth/logout.php" class="btn btn-secondary">Uitloggen</a>
                <?php else: ?>
                    <a href="auth/login.php" class="btn btn-secondary">Inloggen</a>
                <?php endif; ?>
        </ul>
        </nav>

    <!-- <div class="logout">
        <p><a href="#">Logout-></a></p>
    </div> -->
    </header>
    