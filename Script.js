document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('login-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();  
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        fetch('login_form.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.authenticated) {
                alert(data.message); 
                window.location.href = 'dashboard.html'; 
            } else {
                alert(data.message); 
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Login failed due to an error.'); 
        });
    });

    let startX, startY;

    function handleSwipe(startX, startY, endX, endY) {
        let distX = endX - startX;
        let distY = endY - startY;
        if (Math.abs(distX) > Math.abs(distY)) {
            if (distX > 0) {
                navigateRight();
            } else {
                navigateLeft();
            }
        }
    }

    document.addEventListener('mousedown', function(e) {
        startX = e.clientX;
        startY = e.clientY;
    });

    document.addEventListener('mouseup', function(e) {
        handleSwipe(startX, startY, e.clientX, e.clientY);
    });

    function navigateRight() {
        switch (window.location.pathname.split("/").pop()) {
            case 'index.html':
                window.location.href = 'dashboard.html';
                break;
            case 'dashboard.html':
                window.location.href = 'exercises.html';
                break;
            case 'exercises.html':
                window.location.href = 'plans.html';
                break;
            case 'plans.html':
                window.location.href = 'progress.html';
                break;
        }
    }

    function navigateLeft() {
        switch (window.location.pathname.split("/").pop()) {
            case 'dashboard.html':
                window.location.href = 'index.html';
                break;
            case 'exercises.html':
                window.location.href = 'dashboard.html';
                break;
            case 'plans.html':
                window.location.href = 'exercises.html';
                break;
            case 'progress.html':
                window.location.href = 'plans.html';
                break;
        }
    }
});
