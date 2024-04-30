function logout() {
    const confirmLogout = confirm("Are you sure you want to logout?");
    if (confirmLogout) {
        // Send a request to logout.php using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '../citizen/logout.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Redirect the user to index.html after successful logout
                window.location.href = "../index.html";
            } else {
                // Handle errors if needed
                console.error('Error:', xhr.statusText);
            }
        };
        xhr.onerror = function () {
            // Handle network errors if needed
            console.error('Network error');
        };
        xhr.send();
    }
}