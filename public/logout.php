<?php

require_once __DIR__ . '/../app/controllers/AuthController.php';

$authController = new AuthController();
$authController->logout();

// Redirect to login page or any other page after logout
header("Location: index.php");
exit;

?>
