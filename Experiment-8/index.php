<!DOCTYPE html>
<html>
<head>
    <title>AJAX REST API - Post Explorer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Post Explorer</h1>
        <p>Fetch posts from a public REST API using AJAX.</p>

        <div class="search-box">
            <label for="userId">Select User ID (1-10):</label>

            <input type="number" id="userId" min="1" max="10" value="1">

            <button onclick="fetchPosts()">Fetch Posts</button>
        </div>

        <p id="status"></p>

        <div id="posts"></div>
    </div>

    <script src="script.js"></script>
</body>
</html>