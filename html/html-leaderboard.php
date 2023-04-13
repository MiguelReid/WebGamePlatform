<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include '../php/leaderboard.php'; ?>
    <?php include 'NavigationBar.php'; ?>



    <script>

        function createTable() {
            var names = leaderboardNames();
            console.log(names);
            var scores = leaderboardScores();

            var table = document.createElement('table');
            var tableBody = document.createElement('tbody');

            names.forEach(function (rowData) {
                var row = document.createElement('tr');

                rowData.forEach(function (cellData) {
                    var cell = document.createElement('td');
                    cell.appendChild(document.createTextNode(cellData));
                    row.appendChild(cell);
                });

                tableBody.appendChild(row);
            });

            table.appendChild(tableBody);
            document.body.appendChild(table);
        }

        var httpRequest;
        function scoreAlert() {
            if (httpRequest.readyState == 4) {
                if (httpRequest.status == 200) {
                    var restxt = httpRequest.responseText;
                    return restxt;
                }
            }
        }

        function leaderboardNames() {
            var postdata = 'action=leaderboardNames';
            httpRequest = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP");
            httpRequest.onreadystatechange = scoreAlert;
            httpRequest.open('POST', '../php/leaderboard.php', true);
            httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequest.send(postdata);

            if (httpRequest.readyState == 4) {
                if (httpRequest.status == 200) {
                    var restxt = httpRequest.responseText;
                    console.log(restxt);
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

        window.onload = createTable();

    </script>

</body>

</html>