<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit;

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Welcome, <?php echo htmlspecialchars($_SESSION["name"]); ?>!</h1>

    <p>You have successfully logged in.</p>

    <p>Your session is currently active.</p>

    <a href="logout.php">
        <button>Logout</button>
    </a>

</div>

</body>
</html>