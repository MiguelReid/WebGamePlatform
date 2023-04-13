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
    $eyes = $_POST['eyesSelector'];
    $mouth = $_POST['mouthSelector'];
    $skin = $_POST['skinSelector'];
    $difficulty = $_POST['avatarSelector'];

    if (preg_match('/[”!@#%&*()+=^{}—;:“’<>?]/', $name)) {
        // Do not accept the session
    } else {
        setcookie("username", $name, 0, "/");
        setcookie("eyes", $eyes, 0, "/");
        setcookie("mouth", $mouth, 0, "/");
        setcookie("skin", $skin, 0, "/");
        setcookie("difficulty", $difficulty, 0, "/");
        header('Location: ../html/html-index.php');
    }
    ?>

</body>

</html>