<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include '../css/pairs.css'; ?>
    </style>
</head>

<body>
    <?php include '../php/pairs.php'; ?>
    <?php include 'NavigationBar.php'; ?>

    <div id="background">
        <div class="controls">
            <button id="playButton" onclick=gameDifficulty()>Start the game</button>
        </div>
        <div id="board"></div>
    </div>
    </br>
    <div id="stats">
        <div id="moves">0 moves</div>
        <div id="timer">time: 0 sec</div>
    </div>



    <script>

        const values = {
            board: document.getElementById('board'),
            moves: document.getElementById('moves'),
            timer: document.getElementById('timer'),
            play: document.getElementById('playButton'),
        }

        const state = {
            gameStarted: false,
            flippedCards: 0,
            totalFlips: 0,
            totalTime: 0,
            loop: null
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

        function shuffle(array) {
            // Fisher-Yates shuffle
            let currentIndex = array.length, randomIndex;

            while (currentIndex != 0) {
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex--;
                [array[currentIndex], array[randomIndex]] = [
                    array[randomIndex], array[currentIndex]];
            }
            return array;
        }

        function gameDifficulty() {
            document.getElementById('playButton').style.display = 'none';
            var difficulty = getCookie("difficulty");
            switch (difficulty) {
                case "simple":
                    initializeGame(3, false);
                    break;
                case "medium":
                    initializeGame(5, false);
                    break;
                case "complex":
                    initializeGame(5, true);
                    break;
            }
        }

        function initializeGame(cards, flag) {
            var eyes = ['closed', 'laughing', 'long', 'normal', 'rolling', 'winking'];
            var mouth = ['open', 'sad', 'smiling', 'straight', 'surprise', 'teeth'];
            var skin = ['green', 'red', 'yellow'];
            var eyesS = shuffle(eyes).slice(0, cards);
            var mouthS = shuffle(mouth).slice(0, cards);
            var skinS = shuffle(skin).slice(0, cards);

            if (cards == 3) {
                values.board.style.gridTemplateColumns = 'repeat(3, 40px)';
            }


            for (var i = 0; i < cards * 2; i++) {
                var img = document.createElement('img');
                img.className = 'card';
                img.id = 'img' + i;
                img.src = '../resources/mouth/sad.png'
                values.board.appendChild(img);

            }

            playGame();
        }

        function playGame() {

        }

    </script>

</body>

</html>