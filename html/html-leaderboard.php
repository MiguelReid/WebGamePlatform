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

    <script>

        function createTable(data) {

            var table = document.createElement('table');
            var tableBody = document.createElement('tbody');

            var header1 = document.createElement('th');
            header1.innerHTML = 'Username';
            var header2 = document.createElement('th');
            header2.innerHTML = 'Points';
            tableBody.appendChild(header1);
            tableBody.appendChild(header2);
            var score = data.filter((v, i) => i % 2);
            var names = data.filter((v, i) => !(i % 2));

            if (data.length != 0) {
                for (var i = 0; i < names.length; i++) {
                    var row = document.createElement('tr');
                    var cellName = document.createElement('td');
                    cellName.innerHTML = names[i];
                    //cellName.appendChild(names[i]);
                    var cellScore = document.createElement('td');
                    cellScore.innerHTML = score[i];
                    //cellScore.appendChild(score[i]);
                    row.appendChild(cellName);
                    row.appendChild(cellScore);

                    tableBody.appendChild(row);
                }
            }

            table.appendChild(tableBody);
            document.body.appendChild(table);
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

        function leaderboardScores() {
            var postdata = 'action=leaderboardScores';
            httpRequest = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP");
            httpRequest.onreadystatechange = scoreAlert;
            httpRequest.open('POST', '../php/leaderboard.php', true);
            httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequest.send(postdata);
        }

        window.onload = leaderboardScores();

    </script>

</body>

</html>