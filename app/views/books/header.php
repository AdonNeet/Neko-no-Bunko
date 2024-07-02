<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuBar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .navbar-nav .nav-link {
            color: #000;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .icons{
        text-align: center;
        min-width: 20vh;
        text-decoration: none;
        }

        .icons > *{
        font-size: 1.5rem;
        color:var(--black);
        cursor: pointer;
        margin-left: 1.5rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a class="navbar-brand" href="#" style="font-weight: bold;">BuBar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#main">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Books</a></li>
            <li class="nav-item"><a class="nav-link" href="#about-us">About Us</a></li>
        </ul>
    </div>
    <div class="icons" style="">
         <a href="search.php" class="fas fa-search"></a>
         <a href="profile.php" id="user-btn" class="fas fa-user"></a>
      </div>
    
</nav>
