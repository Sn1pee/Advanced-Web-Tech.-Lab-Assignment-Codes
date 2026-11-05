
<?php
require "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $roll = trim($_POST["roll_number"] ?? "");
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $department = trim($_POST["department"] ?? "");
    $semester = filter_var(
        $_POST["semester"] ?? "",
        FILTER_VALIDATE_INT
    );

    if (
        $roll === "" || $name === "" ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        $department === "" ||
        $semester === false ||
        $semester < 1 || $semester > 8
    ) {
        $error = "Please enter valid student details.";
    } else {
        try {
            $stmt = $pdo->prepare(
                "INSERT INTO students
                (roll_number, name, email, department, semester)
                VALUES (?, ?, ?, ?, ?)"
            );

            $stmt->execute([
                $roll, $name, $email, $department, $semester
            ]);

            header("Location: index.php?msg=added");
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() === "23000") {
                $error = "This roll number already exists.";
            } else {
                $error = "Unable to save student record.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student - DTU</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">DTU</div>
    <div>
        <h2>Delhi Technological University</h2>
        <p>Student Record Management System</p>
    </div>
</header>

<main class="container">

    <div class="form-card">
        <h1>Add New Student</h1>
        <p>Enter the student details below.</p>

        <?php if ($error): ?>
            <div class="error-message"><?= escape($error) ?></div>
        <?php endif; ?>

        <form method="POST">

            <label>Roll Number</label>
            <input type="text" name="roll_number"
                   value="<?= escape($_POST["roll_number"] ?? "") ?>"
                   placeholder="23/CS/266" required>

            <label>Full Name</label>
            <input type="text" name="name"
                   value="<?= escape($_POST["name"] ?? "") ?>"
                   placeholder="Student name" required>

            <label>Email Address</label>
            <input type="email" name="email"
                   value="<?= escape($_POST["email"] ?? "") ?>"
                   placeholder="student@example.com" required>

            <label>Department</label>
            <select name="department" required>
                <option value="">Select Department</option>
                <?php foreach (["CSE", "IT", "Software Engineering",
                                "ECE", "Electrical", "Mechanical",
                                "Civil"] as $dept): ?>
                    <option value="<?= escape($dept) ?>"
                        <?= ($_POST["department"] ?? "") === $dept
                            ? "selected" : "" ?>>
                        <?= escape($dept) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Semester</label>
            <input type="number" name="semester"
                   min="1" max="8"
                   value="<?= escape($_POST["semester"] ?? "") ?>"
                   required>

            <button type="submit" class="btn">Save Student</button>
            <a href="index.php" class="back-link">Cancel</a>

        </form>
    </div>

</main>
</body>
</html>
