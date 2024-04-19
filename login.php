<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | PINE HR</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
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



    * {
        font-family: sans-serif;
        box-sizing: border-box;
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
</style>

<body>
</body>

<form action="login_auth.php" method="post">
    <div class="container"><br><br><br><br><br><br>
        <a href="index.php"><img src="bgimages/pine.png" alt="logo" style="width: 195px;height: 185px;margin-left: 110px"></a>
        <a>

            <h1 style="font-family: 'Glacial Indifference'; font-size:18px">HUMAN RESOURCE <br>MONITORING AND PROFILING<br>MANAGEMENT SYSTEM </h1>
        </a>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <?php if (isset($_GET['error2'])) { ?>

            <p class="error2"><?php echo $_GET['error2']; ?></p>
        <?php } ?><br>

        <input type="text" name="em_email" placeholder="Email">
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
        </body>
        
</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>

</html>