
<?php

$students = [
    "23/CS/266" => [
        "name" => "Monish Rai",
        "department" => "Computer Science & Engineering",
        "semester" => 5,
        "subjects" => [
            "Database Management Systems" => 88,
            "Operating Systems" => 82,
            "Computer Networks" => 91,
            "Web Technology" => 95,
            "Machine Learning" => 86
        ]
    ],

    "23/CS/101" => [
        "name" => "Aarav Sharma",
        "department" => "Computer Science & Engineering",
        "semester" => 5,
        "subjects" => [
            "Database Management Systems" => 78,
            "Operating Systems" => 84,
            "Computer Networks" => 72,
            "Web Technology" => 89,
            "Machine Learning" => 81
        ]
    ],

    "23/IT/102" => [
        "name" => "Priya Gupta",
        "department" => "Information Technology",
        "semester" => 5,
        "subjects" => [
            "Database Management Systems" => 91,
            "Operating Systems" => 87,
            "Computer Networks" => 93,
            "Web Technology" => 90,
            "Machine Learning" => 88
        ]
    ]
];

$roll = trim($_POST["roll"] ?? "");
$student = $students[$roll] ?? null;

if ($student) {
    $marks = $student["subjects"];

    $total = array_sum($marks);
    $maximum = count($marks) * 100;
    $percentage = ($total / $maximum) * 100;

    $passed = true;

    foreach ($marks as $mark) {
        if ($mark < 40) {
            $passed = false;
            break;
        }
    }

    if (!$passed) {
        $grade = "F";
    } elseif ($percentage >= 90) {
        $grade = "A+";
    } elseif ($percentage >= 80) {
        $grade = "A";
    } elseif ($percentage >= 70) {
        $grade = "B";
    } elseif ($percentage >= 60) {
        $grade = "C";
    } else {
        $grade = "D";
    }

    $status = $passed ? "PASS" : "FAIL";
}

function safe($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result - DTU</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
        <div class="logo-circle">DTU</div>
        <div>
            <h2>Delhi Technological University</h2>
            <p>Student Result Management System</p>
        </div>
    </div>
</header>

<main class="container">

<?php if ($student): ?>

    <div class="heading">
        <p class="section-label">Academic Performance</p>
        <h1>Student Result</h1>
        <p>Semester Examination Report</p>
    </div>

    <div class="result-card">

        <div class="student-info">
            <p><strong>Name:</strong>
                <?= safe($student["name"]) ?></p>

            <p><strong>Roll Number:</strong>
                <?= safe($roll) ?></p>

            <p><strong>Department:</strong>
                <?= safe($student["department"]) ?></p>

            <p><strong>Semester:</strong>
                <?= safe($student["semester"]) ?></p>
        </div>

        <h3>Subject-wise Performance</h3>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Maximum Marks</th>
                        <th>Marks Obtained</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($marks as $subject => $mark): ?>
                    <tr>
                        <td><?= safe($subject) ?></td>
                        <td>100</td>
                        <td><?= safe($mark) ?></td>
                        <td>
                            <?= $mark >= 40 ? "Pass" : "Fail" ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="summary">
            <div>
                <p>Total Marks</p>
                <h2><?= $total ?> / <?= $maximum ?></h2>
            </div>

            <div>
                <p>Percentage</p>
                <h2><?= number_format($percentage, 2) ?>%</h2>
            </div>

            <div>
                <p>Grade</p>
                <h2><?= $grade ?></h2>
            </div>

            <div>
                <p>Result</p>
                <h2 class="<?= $passed ? 'pass' : 'fail' ?>">
                    <?= $status ?>
                </h2>
            </div>
        </div>

    </div>

<?php else: ?>

    <div class="search-card">
        <h2>Result Not Found</h2>
        <p>
            No student record was found for the entered roll number.
        </p>
        <p>Please check your roll number and try again.</p>
    </div>

<?php endif; ?>

    <div class="back-link">
        <a href="index.php">← Back to Search</a>
    </div>

</main>

<footer>
    © 2026 Delhi Technological University |
    Web Technology Practical
</footer>

</body>
</html>
