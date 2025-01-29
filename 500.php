<?php
//require './Navigation_Links.php';
global $routes, $backend_routes;
require './routes.php';

session_start();
$logout_controller_file = $backend_routes['logout_controller'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car - Dealers -> Add Cars</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/dashboard_dropdown.css">
    <link rel="stylesheet" href="../css/health_card.css">

    <style>
        body {
            background-color: rgb(51, 51, 51);
            color: white;
            font-family: 'Arial Black';
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .error-num {
            font-size: 8em;
        }

        .eye {
            background: #fff;
            border-radius: 50%;
            display: inline-block;
            height: 100px;
            position: relative;
            width: 100px;
            margin: 0 20px;
        }

        .eye::after {
            background: #000;
            border-radius: 50%;
            bottom: 56.1px;
            content: '';
            height: 33px;
            position: absolute;
            right: 33px;
            width: 33px;
        }

        p {
            margin-bottom: 4em;
        }

        a {
            color: white;
            text-decoration: none;
            text-transform: uppercase;
        }

        a:hover {
            color: lightgray;
        }

        @media (max-width: 768px) {
            .error-num {
                font-size: 4em;
            }

            .eye {
                height: 50px;
                width: 50px;
            }

            .eye::after {
                bottom: 28px;
                right: 28px;
                height: 16px;
                width: 16px;
            }

            p {
                margin-bottom: 2em;
            }
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('mousemove', function(event) {
                var containerOffset = $('body').offset();
                var containerX = containerOffset.left + ($('body').width() / 2);
                var containerY = containerOffset.top + ($('body').height() / 2);

                $('.eye').each(function() {
                    var e = $(this);
                    var x = e.offset().left + (e.width() / 2);
                    var y = e.offset().top + (e.height() / 2);
                    var rad = Math.atan2(event.pageX - containerX, event.pageY - containerY);
                    var rot = (rad * (180 / Math.PI) * -1) + 180;
                    e.css({
                        '-webkit-transform': 'rotate(' + rot + 'deg)',
                        'transform': 'rotate(' + rot + 'deg)'
                    });
                });
            });
        });
    </script>

</head>
<body>
<div>
    <span class='error-num'>5</span>
    <div class='eye'></div>
    <div class='eye'></div>
    <p class='sub-text'>It's always time for a coffee break.<br>
        We should be back by the time you finish your coffee.</p>
    <a href='<?php echo $logout_controller_file; ?>'>Go back</a>
</div>
</body>
</html>
