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
        <div id="win"></div>
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
            win: document.getElementById('win')
        }

        const state = {
            gameStarted: false,
            totalFlips: 0,
            flippedCards: 0,
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

            values.board.style.gridTemplateColumns = `repeat(${cards}, 40px)`;

            var children = []
            const prefixUrl = "../resources/";

            for (var i = 0; i < cards * 2; i++) {
                var img = document.createElement('div');
                img.className = 'card';
                img.id = 'img' + i;

                img.style.backgroundImage = "url('../resources/exeter.png')";
                img.style.backgroundPosition = "center";
                img.style.backgroundSize = "cover";

                var thisEyes = "eyes/" + eyesS[Math.floor(i / 2)] + ".png";

                img.style.eyes = prefixUrl + thisEyes;

                var cardEyes = document.createElement("img");
                cardEyes.className = 'cardEyes';
                cardEyes.id = 'eye' + i;
                var cardMouth = document.createElement("img");
                cardMouth.className = 'cardMouth';
                cardMouth.id = 'mouth' + i;
                var cardSkin = document.createElement("img");
                cardSkin.className = 'cardSkin';
                cardSkin.id = 'skin' + i;

                cardEyes.src = prefixUrl + thisEyes;
                cardMouth.src = prefixUrl + "mouth/" + mouthS[Math.floor(i / 2)] + ".png";
                cardSkin.src = prefixUrl + "skin/" + skinS[Math.floor(i / 2)] + ".png";

                img.appendChild(cardMouth);
                img.appendChild(cardEyes);
                img.appendChild(cardSkin);

                children.push(img);
                img.onclick = function () { rotateImage(this) };
            }

            shuffle(children);

            for (const child of children) {
                values.board.appendChild(child);
            }

            playGame(cards);
        }

        var rotateCounter = 0;
        var visibleNodes = [];
        var flippedCard = [];

        async function rotateImage(image) {
            state.totalFlips++;
            var nodes = image.childNodes;
            for (var i = 0; i < nodes.length; i++) {
                if (nodes[i].nodeName.toLowerCase() == 'img') {
                    nodes[i].style.visibility = "visible";
                    visibleNodes.push(nodes[i]);
                    rotateCounter++;
                }
            }

            flippedCard.push(image);

            if (rotateCounter == 6) {
                if (flippedCard[0].style.eyes == flippedCard[1].style.eyes) {
                    state.flippedCards += 2;
                    flippedCard[0].style.cursor = "default";
                    flippedCard[1].style.cursor = "default";
                    flippedCard[0].onclick =  '';
                    flippedCard[1].onclick = '';

                } else {
                    const wait = await timeStop();
                    for (var i = 0; i < visibleNodes.length; i++) {
                        visibleNodes[i].style.visibility = "hidden";
                    }
                }

                visibleNodes = [];
                flippedCard = [];
                rotateCounter = 0;
            }
        }

        function timeStop() {
            return new Promise(resolve => {
                setTimeout(() => {
                    resolve('resolved');
                }, 1000);
            });
        }

        function playGame(cards) {
            state.gameStarted = true

            state.loop = setInterval(() => {
                state.totalTime++
                values.moves.innerText = `${state.totalFlips} moves`
                values.timer.innerText = `time: ${state.totalTime} sec`

                if (state.flippedCards == cards * 2) {
                    var points = 100 - state.totalFlips - state.totalTime;
                    values.win.innerHTML = `
                            <span class="win-text">
                                You won!<br />
                                    with <span class="highlight">${points}</span> points
                            </span> 
                            `
                    clearInterval(state.loop)
                }
            }, 1000)
        }

    </script>

</body>

</html>