<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <?php

    $name = $_POST['username'];

    if (preg_match('/[”!@#%&*()+=^{}—;:“’<>?]/', $name)) {
        // Do not accept the session
    } else {
        setcookie("username", $name, 0, "/");
        //echo ("User Registered!");
        header('Location: ../html/html-index.php');
    }
    ?>



</body>

</html>