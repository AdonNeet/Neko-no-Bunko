<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuBar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-nav .nav-link {
            color: #000;
        }
        .jumbotron {
            background-color: #FFA500;
            color: #000;
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .jumbotron .display-4 {
            font-weight: bold; 
        }
        .about-us, .faq {
            padding: 60px 0;
        }
        .about-us .card {
            margin: 20px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .faq .card {
            border: none; /* Remove border */
            align-items: center;
        }
        .faq .card-header {
            background-color: transparent; /* Remove background color of header */
        }
        .faq .card-header .btn {
            color: #000; /* Change button text color */
        }
        .faq .card-body {
            background-color: transparent; /* Change card body background color */
            color: #000; /* Change card body text color */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a class="navbar-brand" href="#">BuBar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#main">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Books</a></li>
            <li class="nav-item"><a class="nav-link" href="#about-us">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Kategori</a></li>
        </ul>
    </div>
</nav>
