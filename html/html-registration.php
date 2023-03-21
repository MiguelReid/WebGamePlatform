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

    <form action="../php/registration.php" method="post" onsubmit="return submitForm()">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username">
        <span id="error"></span>
        <br><br>

        <label for="avatarSelector">Select avatar type:</label>
        <select name="avatarSelector" id="avatarSelector" onchange="showDiv('images', this)">
            <option value="simple">simple</option>
            <option value="medium">medium</option>
            <option value="complex">complex</option>
        </select><br>

        <div id="complexOptions">
            <label for="eyesSelector" id="label">Select eyes type:</label>
            <select name="eyesSelector" id="eyesSelector" onchange="changeFace('eyes', this)">
                <option value="closed">closed</option>
                <option value="laughing">laughing</option>
                <option value="long">long</option>
                <option value="normal">normal</option>
                <option value="rolling">rolling</option>
                <option value="winking">winking</option>
            </select><br>

            <label for="mouthSelector" id="label">Select mouth type:</label>
            <select name="mouthSelector" id="mouthSelector" onchange="changeFace('mouth', this)">
                <option value="open">open</option>
                <option value="sad">sad</option>
                <option value="smiling">smiling</option>
                <option value="straight">straight</option>
                <option value="surprise">surprise</option>
                <option value="teeth">teeth</option>
            </select><br>

            <label for="skinSelector" id="label">Select skin type:</label>
            <select name="skinSelector" id="skinSelector" onchange="changeFace('skin', this)">
                <option value="green">green</option>
                <option value="red">red</option>
                <option value="yellow">yellow</option>
            </select>
        </div>
        <br>
        <input type="submit" value="Submit" name="submit">
    </form>

    <br>
    <div id="images">
        <img src="../resources/eyes/closed.png" id="eyes" />
        <img src="../resources/mouth/open.png" id="mouth" />
        <img src="../resources/skin/green.png" id="skin" />
    </div>

    <script>
        function changeFace(bodyPart, option) {
            var img = document.getElementById(bodyPart);
            var source = "../resources/" + bodyPart + "/" + option.value + ".png";
            img.src = source;
            document.getElementById('navBar'+bodyPart).src = source;
        }

        function showDiv(divId, element) {
            document.getElementById(divId).style.display = element.value == "complex" || element.value == "medium" ? 'block' : 'none';
            var options = document.getElementById("complexOptions");
            if (element.value == "complex") {
                options.style.visibility = "visible";
            } else {
                options.style.visibility = "hidden";
            }
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
            } else {
                return true;
            }
        }
    </script>

</body>

</html>