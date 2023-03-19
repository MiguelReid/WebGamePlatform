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

    <form action="" method="post" onsubmit="return submitForm()">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username">
        <span id="error"></span>
        <br><br>

        <label for="avatarSelector">Select avatar type:</label>
        <select name="avatarSelector" id="avatarSelector" onchange="showDiv('images', this)" multiple>
            <option value="simple">simple</option>
            <option value="medium">medium</option>
            <option value="complex">complex</option>
        </select><br><br>
        <input type="submit" value="Submit" name="submit">
    </form>

    <br>
    <div id="images">
        <img src="../resources/eyes/closed.png" id="eyes" />
        <img src="../resources/mouth/open.png" id="mouth" />
        <img src="../resources/skin/green.png" id="skin" />
    </div>

    <script>
        function showDiv(divId, element) {
            document.getElementById(divId).style.display = element.value == "complex" ? 'block' : 'none';
        }

        function submitForm() {
            var username = document.getElementById('username').value;
            var regex = /[”!@#%&*()+=^{}—;:“’<>?]/;
            var result = regex.test(username);
            if (result) {
                var error = document.getElementById("error");
                error.textContent = "Please enter a valid username";
                error.style.color = "red";
                return false;
            }else{
                return true;
            }
        }
    </script>

</body>

</html>