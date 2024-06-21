<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/session.php';

$conn = require __DIR__ . '/database.php';

function login($username, $password) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        setSession('user_id', $user['uid']);
        setSession('username', $user['username']);
        return true;
    }

    return false;
}

function logout() {
    unsetSession('user_id');
    unsetSession('username');
    destroySession();
}

function checkAuth() {
    return getSession('user_id') !== null;
}

function getUser() {
    if (checkAuth()) {
        return [
            'id' => getSession('user_id'),
            'username' => getSession('username')
        ];
    }

    return null;
}

function register($username, $password) {
    global $conn;

    // Check if the username already exists
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return false; // Username already taken
    }

    // Insert new user
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->bind_param('ss', $username, $hashedPassword);
    
    return $stmt->execute();
}
?>