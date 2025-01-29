// Function to switch between pages
function showPage(pageId) {
    document.querySelectorAll('.page').forEach(page => {
        page.classList.add('hidden');
    });

    document.getElementById(pageId).classList.remove('hidden');
}

// Function to simulate token request
function requestToken() {
    const status = document.getElementById('token-status');
    status.textContent = "Token Requested!";
    status.style.color = "green";
}
