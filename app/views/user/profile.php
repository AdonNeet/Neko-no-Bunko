<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="/public/css/styles.css">
</head>
<body>
    <h1>User Profile</h1>
    <p>Welcome, <?= htmlspecialchars($user['username']) ?></p>
    <a href="/logout">Logout</a>
</body>
</html>
