
<?php
require "db.php";

$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTU Student Management</title>
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

    <div class="page-heading">
        <div>
            <p class="label">STUDENT DATABASE</p>
            <h1>Student Records</h1>
            <p>Manage student information using PHP and MySQL.</p>
        </div>

        <a href="add.php" class="btn">+ Add Student</a>
    </div>

    <?php if (isset($_GET["msg"])): ?>
        <div class="message">
            <?php
            $messages = [
                "added" => "Student added successfully.",
                "updated" => "Student updated successfully.",
                "deleted" => "Student deleted successfully."
            ];
            echo escape($messages[$_GET["msg"]] ?? "");
            ?>
        </div>
    <?php endif; ?>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Roll Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Semester</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= escape($student["id"]) ?></td>
                    <td><?= escape($student["roll_number"]) ?></td>
                    <td><?= escape($student["name"]) ?></td>
                    <td><?= escape($student["email"]) ?></td>
                    <td><?= escape($student["department"]) ?></td>
                    <td><?= escape($student["semester"]) ?></td>

                    <td>
                        <div class="actions">
                            <a class="edit-btn"
                               href="edit.php?id=<?= (int)$student["id"] ?>">
                               Edit
                            </a>

                            <form action="delete.php" method="POST"
                                  onsubmit="return confirm('Delete this student?');">
                                <input type="hidden" name="id"
                                       value="<?= (int)$student["id"] ?>">
                                <button type="submit" class="delete-btn">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (empty($students)): ?>
            <p class="empty">No student records found.</p>
        <?php endif; ?>
    </div>

</main>

<footer>
    © 2026 Delhi Technological University |
    Web Technology Practical
</footer>

</body>
</html>
