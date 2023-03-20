<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include '../css/index.css'; ?>
    </style>
</head>

<body>
    <?php include 'NavigationBar.php'; ?>
    <?php include '../php/index.php'; ?>
    <h1>Welcome to pairs</h1>
    <br>

    <form action="html-pairs.php" id="play">
        <input type="submit" value="Click here to play" />
    </form>
    <br>

    <p id="registerLink"><a href="html-registration.php">You're not using a registered session? Register now!</a></p>

    <script>
        function getCookie(name) {
            var dc = document.cookie;
            var prefix = name + "=";
            var begin = dc.indexOf("; " + prefix);
            if (begin == -1) {
                begin = dc.indexOf(prefix);
                if (begin != 0) return null;
            }
            else {
                begin += 2;
                var end = document.cookie.indexOf(";", begin);
                if (end == -1) {
                    end = dc.length;
                }
            }
            return decodeURI(dc.substring(begin + prefix.length, end));
        }

        window.onload = function checkCookies() {
            var myCookie = getCookie("username");
            var register = document.getElementById("registerLink");
            console.log(register);
            var play = document.getElementById("play");

            if (myCookie == null) {
                register.style.visibility = "visible";
                play.style.visibility = "hidden";
                document.getElementById("register").style.visibility = "visible";
                document.getElementById("leaderboard").style.visibility = "hidden";
            } else {
                play.style.visibility = "visible";
                register.style.visibility = "hidden";
                document.getElementById("register").style.visibility = "hidden";
                document.getElementById("leaderboard").style.visibility = "visible";
            }
        }
    </script>
</body>

</html>