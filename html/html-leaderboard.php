<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include '../css/leaderboard.css'; ?>
    </style>
</head>

<body>
    <?php include '../php/leaderboard.php'; ?>
    <?php include 'NavigationBar.php'; ?>

    <div id="background">

    </div>

    <script>

        function createTable(data) {

            var table = document.createElement('table');
            var tableBody = document.createElement('tbody');

            var header1 = document.createElement('th');
            header1.innerHTML = 'Username';
            var header2 = document.createElement('th');
            header2.innerHTML = 'Level 1';
            var header3 = document.createElement('th');
            header3.innerHTML = 'Level 2';
            var header4 = document.createElement('th');
            header4.innerHTML = 'Level 3';
            var header5 = document.createElement('th');
            header5.innerHTML = 'Total Points';

            tableBody.appendChild(header1);
            tableBody.appendChild(header2);
            tableBody.appendChild(header3);
            tableBody.appendChild(header4);
            tableBody.appendChild(header5);

            const arrays = [[], [], [], [], []];

            data.forEach((item, index) => {
                arrays[index % 5].push(item);
            });

            if (data.length != 0) {
                for (var i = 0; i < data.length/5; i++) {
                    var row = document.createElement('tr');

                    var cellName = document.createElement('td');
                    cellName.innerHTML = arrays[0][i];

                    var cellFirstLevel = document.createElement('td');
                    cellFirstLevel.innerHTML = arrays[1][i];

                    var cellSecondLevel = document.createElement('td');
                    cellSecondLevel.innerHTML = arrays[2][i];

                    var cellThirdLevel = document.createElement('td');
                    cellThirdLevel.innerHTML = arrays[3][i];

                    var cellScore = document.createElement('td');
                    cellScore.innerHTML = arrays[4][i];

                    row.appendChild(cellName);
                    row.appendChild(cellFirstLevel);
                    row.appendChild(cellSecondLevel);
                    row.appendChild(cellThirdLevel);
                    row.appendChild(cellScore);
                    tableBody.appendChild(row);
                }
            }

            table.appendChild(tableBody);
            document.getElementById('background').appendChild(table);
        }

        var httpRequest;
        function scoreAlert() {
            if (httpRequest.readyState == 4) {
                if (httpRequest.status == 200) {
                    var restxt = httpRequest.responseText;
                    createTable(JSON.parse(restxt));
                }
            }
        }

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

        function checkCookies() {
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

        window.onload = function leaderboardScores() {
            checkCookies();
            var postdata = 'action=leaderboardScores';
            httpRequest = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP");
            httpRequest.onreadystatechange = scoreAlert;
            httpRequest.open('POST', '../php/leaderboard.php', true);
            httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequest.send(postdata);
        }

    </script>

</body>

</html>