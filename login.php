<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['s_em_email'])) {
    // If the user is not on the logout page, redirect to login page
    if (basename($_SERVER['PHP_SELF']) !== 'logout.php') {
        header("Location: login.php");
        exit();
    }
}

// Clear the session data for email and password if they exist
if (isset($_SESSION['s_em_email'])) {
    unset($_SESSION['s_em_email']);
}
if (isset($_SESSION['s_em_password'])) {
    unset($_SESSION['s_em_password']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | PINE HR</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

    <!--font links google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
</head>
<style>
    html,
    body {
        height: 100%;
    }

    body {

        background-image: url('./bgimages/login.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;

    }

    body {
        height: 65%;
        justify-content: center;
        padding-top: 300px;
    }

    /*font google*/


    * {
        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-style: normal;
    }



    form {
        color: black;
        height: 987px;
        width: 500px;
        padding: 40px;
        background: #2468a0;
        border-radius: 0px;
        font-family: sans-serif;
        margin-top: -330px;
        margin-left: -10px;
    }

    h2 {
        color: white;
        text-align: center;
        margin-bottom: 40px;
        font-family: sans-serif
    }

    a {
        color: white;
        text-decoration: none;
    }

    input {
        color: black;
        display: block;
        border: 2px solid black;
        width: 95%;
        height: 95%;
        padding: 10px;
        margin: 30px auto;
        border-radius: 1px;
        font-family: sans-serif;

    }


    select option {
        display: block;
        border: 2px solid white;
        width: 95%;
        padding: 10px;
        margin: 10px auto;
        border-radius: 4px;
        font-family: sans-serif
    }


    button {
        float: right;
        background: orange;
        padding: 10px 15px;
        color: black;
        border-radius: 5px;
        margin-right: 10px;
        border: none;
        font-family: sans-serif;
    }

    button:hover {
        opacity: .7;
    }

    .error2 {
        background: #F2DEDE;
        color: #A94442;
        padding: 10px;
        width: 95%;
        border-radius: 5px;
        margin: 20px auto;
        font-family: sans-serif;
    }



    h1 {
        text-align: center;
        color: #fff;
        font-size: small;
        font-family: sans-serif;
    }



    .ca {
        font-size: 16px;
        display: inline-block;
        padding: 10px;
        color: white;
        font-family: sans-serif;
    }

    .ca:hover {
        text-decoration: underline;
        font-family: sans-serif;
    }

    .error {
        font-size: small;
        width: auto;
        /* Let the width adjust based on content */
        max-width: 50%;
        /* Ensure it doesn't exceed the container width */
        height: auto;
        /* Let the height adjust based on content */
        padding: 5px;
        /* Add some padding for better appearance */
        margin: 12px;
    }
</style>

<body>
</body>

<form action="login_auth.php" method="post">
    <div class="container"><br><br><br><br><br><br>
        <a href="index.php"><img src="bgimages/pine.png" alt="logo" style="width: 195px;height: 185px;margin-left: 110px"></a>
        <a>

            <h1 style="font-size:18px">HUMAN RESOURCE <br>MONITORING AND PROFILING<br>MANAGEMENT SYSTEM </h1>
        </a>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error alert alert-danger" role="alert" id="error-message"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <input type="email" name="em_email" placeholder="Email">
        <input type="password" name="em_password" placeholder="Password"><br>
        <button type="submit" class="login">Login</button>

        <!--
        </form>
        <img src="bgimages/ormoc_seal.png" alt="logo" style="width: 550px;height:550px; margin-left:900px; margin-top: -500px">
        </div>
        -->

        <video autoplay loop muted plays-inline id="bgvideo" class="back-video">
            <source src="bgimages/Ormoc_Seal.mp4" type="video/mp4">
        </video>

        <style>
            .back-video {
                position: absolute;
                right: 0;
                bottom: 0;
                z-index: -1;

            }

            @media(min-aspect-ratio: 16/9) {
                .back-video {
                    width: 100%;
                    height: auto;
                }
            }

            @media(max-aspect-ratio: 16/9) {
                .back-video {
                    width: auto;
                    height: 100%;
                }
            }
        </style>

        <script>
            // Get the error message element
            var errorMessage = document.getElementById('error-message');

            // If the error message element exists
            if (errorMessage) {
                // Set a timeout to make it disappear after 5 seconds
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 5000); // 5000 milliseconds = 5 seconds
            }
        </script>
        </body>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</html>