<?php
require("conn.php");
session_start();
if (isset($_POST['logoutBtn'])) {

    session_destroy();
    header('location:index.php');
}

if (!isset($_SESSION['username'])) {
    echo "<script>alert('You are logged out')</script>";
    echo "<script>location.replace('index.php')</script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(0deg, rgba(59, 93, 80, 1) 32%, rgba(13, 13, 12, 1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        h2 {
            color: #fff;
        }

        button {
            width: 80%;
            height: 40px;
            margin: 30px auto 20px auto;
            justify-content: center;
            display: block;
            color: #fff;
            background: #1e362d;
            font-size: 1em;
            font-weight: bold;
            /* margin-top: 20px; */
            outline: none;
            border: none;
            border-radius: 5px;
            transition: .2s ease-in;
            cursor: pointer;
        }

        button:hover {
            background: #274238;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>WELCOME <?php echo $_SESSION['username']; ?> </h2>
        <button type="submit" name="logoutBtn">Logout</button>
    </form>
</body>

</html>