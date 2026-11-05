<?php
session_start();
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE email = ?"
    );

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {

            session_regenerate_id(true);

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["name"] = $user["name"];

            // Remember email using a cookie
            setcookie("user_email", $email, [
                "expires" => time() + (86400 * 30),
                "path" => "/",
                "httponly" => true,
                "samesite" => "Lax",
                "secure" => !empty($_SERVER["HTTPS"])
            ]);

            header("Location: dashboard.php");
            exit;

        } else {
            $message = "Incorrect password!";
        }

    } else {
        $message = "User not found!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Login</h2>

    <form method="POST">

        <input type="email" name="email"
               placeholder="Email Address"
               value="<?php echo htmlspecialchars($_COOKIE["user_email"] ?? "", ENT_QUOTES); ?>"
               required>

        <input type="password" name="password"
               placeholder="Password" required>

        <button type="submit">Login</button>

    </form>

    <p><?php echo htmlspecialchars($message); ?></p>

    <a href="register.php">Create New Account</a>

</div>

</body>
</html>