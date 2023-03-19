<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>  

<?php

$name = $_GET['username'];

if (preg_match('/[”!@#%&*()+=^{}—;:“’<>?]/', $name))
{
    header('Location: ../html/html-registration.php');

}else{
    echo "There are not special characters";
}
?>

  

</body>

</html>
