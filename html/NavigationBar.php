<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include '../css/NavigationBar.css'; ?>
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="first">
            <a href="../html/html-index.php" id="home">Home</a>
        </div>
        <div id="second">
            <div id="navBarImages">
                <img src="../resources/eyes/closed.png" id="navBareyes" />
                <img src="../resources/mouth/open.png" id="navBarmouth" />
                <img src="../resources/skin/green.png" id="navBarskin" />
            </div>
            <div id="navBarElements">
                <a href="html-pairs.php" id="memory">Memory</a>
                <a href="html-leaderboard.php" id="leaderboard">Leaderboard</a>
                <a href="html-registration.php" id="register">Register</a>
            </div>
        </div>
    </div>

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

        window.onload = function checkCookiesNavBar() {
            var myCookie = getCookie("username");
            var getEyes = getCookie("eyes");
            var getMouth = getCookie("mouth");
            var getSkin = getCookie("skin");

            if (myCookie == null) {
                document.getElementById("register").style.visibility = "visible";
                document.getElementById("leaderboard").style.visibility = "hidden";
                document.getElementById("navBarImages").style.visibility = "hidden";
            } else {
                document.getElementById("register").style.visibility = "hidden";
                document.getElementById("leaderboard").style.visibility = "visible";
                document.getElementById("navBarImages").style.visibility = "visible";

                document.getElementById("navBareyes").src = "../resources/eyes/" + getEyes + ".png";
                document.getElementById("navBarmouth").src = "../resources/mouth/" + getMouth + ".png";
                document.getElementById("navBarskin").src = "../resources/skin/" + getSkin + ".png";
            }
        }
    </script>

</body>

</html>