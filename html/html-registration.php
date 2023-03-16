<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include '../css/registration.css'; ?>
    </style>
</head>

<body>

    <?php include 'NavigationBar.php'; ?>
    
    <form action="../php/registration.php">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username"><br><br>

        <label for="avatarSelector">Select avatar type:</label>
        <select name="avatarSelector" id="avatarSelector" onchange="showDiv('images', this)" multiple>
            <option value="simple">simple</option>
            <option value="medium">medium</option>
            <option value="complex">complex</option>
        </select><br><br>
        <input type="submit" value="Submit">
    </form>

    <script>
    function showDiv(divId, element){
        document.getElementById(divId).style.display = element.value == "complex" ? 'block' : 'none';
    }
    </script>

    <br>
    <div id="images">
        <img src="../resources/eyes/closed.png" id="eyes"/>
        <img src="../resources/mouth/open.png" id="mouth"/>
        <img src="../resources/skin/green.png" id="skin"/>
    </div>

</body>

</html>