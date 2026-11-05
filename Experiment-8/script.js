async function fetchPosts() {

    const userId = document.getElementById("userId").value;
    const postsContainer = document.getElementById("posts");
    const status = document.getElementById("status");

    if (userId < 1 || userId > 10 || userId === "") {
        status.innerText = "Please enter a valid User ID (1-10).";
        postsContainer.innerHTML = "";
        return;
    }

    status.innerText = "Loading posts...";
    postsContainer.innerHTML = "";

    try {
        const response = await fetch(
            `https://jsonplaceholder.typicode.com/posts?userId=${userId}`
        );

        if (!response.ok) {
            throw new Error("Failed to fetch data");
        }

        const posts = await response.json();

        status.innerText = `Showing ${posts.length} posts for User ${userId}`;

        posts.forEach(post => {

            const postCard = document.createElement("div");
            postCard.className = "post-card";

            const title = document.createElement("h3");
            title.textContent = post.title;

            const body = document.createElement("p");
            body.textContent = post.body;

            postCard.appendChild(title);
            postCard.appendChild(body);

            postsContainer.appendChild(postCard);
        });

    } catch (error) {
        status.innerText = "Error: Unable to fetch posts. Please try again.";
        console.error(error);
    }
}