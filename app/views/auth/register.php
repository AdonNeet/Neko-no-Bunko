<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="/public/css/styles.css">
</head>
<body>
    <h1>Register</h1>
    <form method="POST" action="/register">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
