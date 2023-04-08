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
            eyesS = eyesS.concat(eyesS);
            var mouthS = shuffle(mouth).slice(0, cards);
            mouthS = mouthS.concat(mouthS);
            var skinS = shuffle(skin);
            skinS = skinS.concat(skinS);
            // S = shuffled

            // Look at how to make this neater
            if (cards == 3) {
                values.board.style.gridTemplateColumns = 'repeat(3, 40px)';
            } else if (cards == 5) {
                values.board.style.gridTemplateColumns = 'repeat(5, 40px)';
            }

            var children = []
            const prefixUrl = "../resources/";

            for (var i = 0; i < cards * 2; i++) {
                var img = document.createElement('div');
                img.className = 'card';
                img.id = 'img' + i;

                img.style.backgroundImage = "url('../resources/exeter.png')";
                img.style.backgroundPosition = "center";
                img.style.backgroundSize = "cover";

                img.style.eyes = prefixUrl + "eyes/" + eyesS[i] + ".png";
                img.style.mouth = prefixUrl + "mouth/" + mouthS[i] + ".png";
                img.style.skin = prefixUrl + "skin/" + skinS[Math.floor(i / 2)] + ".png";

                children.push(img);
                img.onclick = function () { rotateImage(this.id) };
            }

            shuffle(children);

            for (const child of children) {
                values.board.appendChild(child);
            }

            playGame();
        }

        function rotateImage(id) {
            var image = document.getElementById(id);
            image.style.backgroundImage = "";

            console.log(image.style.eyes);
            console.log(image.style.mouth);
            console.log(image.style.skin);
        }


        function playGame() {

        }

    </script>

</body>

</html>