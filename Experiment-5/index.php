
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTU Student Result Portal</title>
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

    <div class="heading">
        <p class="section-label">Academic Portal</p>
        <h1>Examination Results</h1>
        <p>Enter your roll number to view your academic performance.</p>
    </div>

    <div class="search-card">
        <h2>Student Result Lookup</h2>

        <form action="result.php" method="POST">
            <label for="roll">University Roll Number</label>
            <input type="text" id="roll" name="roll"
                   placeholder="e.g. 23/CS/266" required>

            <button type="submit">View Result</button>
        </form>

        <p class="note">
            Results are available for registered students only.
        </p>
    </div>

</main>

<footer>
    © 2026 Delhi Technological University |
    Web Technology Practical
</footer>

</body>
</html>
