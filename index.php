<?php

global $routes;
require './routes.php';

session_start();
$login_page = $routes['login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event - Management - System</title>
    <style>
        /* CSS for centering the progress bar */
        body {
            background-color: #000;
        }
        .progress-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            text-align: center;
        }
        .progress-bar {
            width: 100%;
            background-color: #f2f2f2;
            border-radius: 20px;
            overflow: hidden;
        }
        .progress-bar-inner {
            width: 0%;
            height: 20px;
            background-color: #ff0000; /* Red color */
            border-radius: 20px;
            transition: width 0.07s linear; /* Adjust duration to match the desired time */
        }
        .progress-text {
            margin-top: 10px;
            color: #fff; /* White text color */
        }
    </style>
</head>
<body>
<div class="progress-container">
    <div class="progress-bar">
        <div class="progress-bar-inner" id="progress-bar-inner"></div>
    </div>
    <div class="progress-text" id="progress-text">Loading...</div>
</div>

<script>
    // JavaScript for progress bar and redirection
    window.onload = function() {
        var progressBar = document.getElementById("progress-bar-inner");
        var progressText = document.getElementById("progress-text");
        var percentage = 0;
        var interval = setInterval(function() {
            percentage += 1;
            progressBar.style.width = percentage + "%";
            progressText.textContent = "Loading... " + percentage + "%";
            if (percentage >= 100) {
                clearInterval(interval);
                setTimeout(function() {
                    window.location.href = "<?php echo $login_page; ?>"; // Redirect after 5 seconds
                }, 350);
            }
        }, 50);
    };
</script>
</body>
</html>
