
<?php
require "db.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    exit("Invalid student ID.");
}

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if (!$student) {
    exit("Student not found.");
}

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
                "UPDATE students
                 SET roll_number = ?, name = ?, email = ?,
                     department = ?, semester = ?
                 WHERE id = ?"
            );

            $stmt->execute([
                $roll, $name, $email,
                $department, $semester, $id
            ]);

            header("Location: index.php?msg=updated");
            exit;

        } catch (PDOException $e) {
            $error = $e->getCode() === "23000"
                ? "This roll number already exists."
                : "Unable to update student record.";
        }
    }

    $student = array_merge($student, [
        "roll_number" => $roll,
        "name" => $name,
        "email" => $email,
        "department" => $department,
        "semester" => $_POST["semester"] ?? ""
    ]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - DTU</title>
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

        <h1>Edit Student</h1>
        <p>Update the student information below.</p>

        <?php if ($error): ?>
            <div class="error-message"><?= escape($error) ?></div>
        <?php endif; ?>

        <form method="POST">

            <label>Roll Number</label>
            <input type="text" name="roll_number"
                   value="<?= escape($student["roll_number"]) ?>" required>

            <label>Full Name</label>
            <input type="text" name="name"
                   value="<?= escape($student["name"]) ?>" required>

            <label>Email Address</label>
            <input type="email" name="email"
                   value="<?= escape($student["email"]) ?>" required>

            <label>Department</label>
            <select name="department" required>
                <?php foreach (["CSE", "IT", "Software Engineering",
                                "ECE", "Electrical", "Mechanical",
                                "Civil"] as $dept): ?>
                    <option value="<?= escape($dept) ?>"
                        <?= $student["department"] === $dept
                            ? "selected" : "" ?>>
                        <?= escape($dept) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Semester</label>
            <input type="number" name="semester"
                   min="1" max="8"
                   value="<?= escape($student["semester"]) ?>" required>

            <button type="submit" class="btn">Update Student</button>
            <a href="index.php" class="back-link">Cancel</a>

        </form>
    </div>

</main>
</body>
</html>
