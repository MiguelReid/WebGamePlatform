<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include '../css/pairs.css'; ?>
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body>
    <?php include '../php/pairs.php'; ?>
    <?php include 'NavigationBar.php'; ?>

    <div id="background">
        <div class="controls">
            <button id="playButton" onclick="gameDifficulty()">Start the game</button>
            <button id="startAgain" onclick="reload()">Play Again</button>
            <button id="submit" onclick="updateScore()">Submit</button>
            <button id="nextGame" onclick="restart()">Next Game</button>
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

        var currentHighscore = 0;
        var userFound = 0;
        var complexGameIndex = 0;
        var levelPoints = [];
        var lvl0 = 0;
        var lvl1 = 0;
        var lvl2 = 0;

        function reload() {
            location.reload();
        }

        function restart() {
            document.getElementById('nextGame').style.display = "none";
            values.board.style.display = "inline-grid";
            state.totalFlips = 0;
            state.flippedCards = 0;
            state.totalTime = 0;
            state.loop = null;
            state.currentPoints = 0;

            for (var i = values.board.children.length - 1; i >= 0; i--) {
                values.board.removeChild(values.board.children[i]);
            }
            complexGame();
        }

        const values = {
            board: document.getElementById('board'),
            moves: document.getElementById('moves'),
            timer: document.getElementById('timer'),
            play: document.getElementById('playButton'),
            win: document.getElementById('win')
        }

        const state = {
            flippedCards: 0,
            loop: null,
            currentPoints: 0,
            totalFlips: 0,
            totalTime: 0
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
            values.play.style.display = 'none';
            var difficulty = getCookie("difficulty");
            switch (difficulty) {
                case "simple":
                    initializeGame(3, false, 0, 6);
                    break;
                case "medium":
                    initializeGame(5, false, 0, 6);
                    break;
                case "complex":
                    complexGame();
                    break;
            }
        }

        function nonClickeable(counter) {
            for (let i = 0; i < counter / 3; i++) {
                flippedCard[i].style.cursor = 'default';
                flippedCard[i].onclick = '';
            }
        }

        function complexGame() {
            switch (complexGameIndex) {
                case 0:
                    initializeGame(5, true, 0, 6);
                    break;
                case 1:
                    lvl1 = state.currentPoints;
                    initializeGame(5, true, 5, 9);
                    break;
                case 2:
                    lvl2 = state.currentPoints;
                    initializeGame(5, true, 10, 12);
                    break;
            }
        }

        var rotateCounter = 0;
        var visibleNodes = [];
        var flippedCard = [];
        var eyesToCheck = [];

        function initializeGame(cards, complex, extraCards, flipCounter) {
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

            for (let i = 0; i < cards * 2 + extraCards; i++) {
                var img = document.createElement('div');
                img.className = 'card';
                img.id = 'img' + i;

                var cardEyes = document.createElement("img");
                cardEyes.className = 'cardEyes';
                cardEyes.id = 'eye' + i;
                var cardMouth = document.createElement("img");
                cardMouth.className = 'cardMouth';
                cardMouth.id = 'mouth' + i;
                var cardSkin = document.createElement("img");
                cardSkin.className = 'cardSkin';
                cardSkin.id = 'skin' + i;

                var thisEyes = "eyes/" + eyesS[Math.floor(i / (flipCounter / 3))] + ".png";
                // FlipCounter/3 so it relates with the number of pairs
                img.style.eyes = prefixUrl + thisEyes;

                cardEyes.src = prefixUrl + thisEyes;
                cardMouth.src = prefixUrl + "mouth/" + mouthS[Math.floor(i / (flipCounter / 3))] + ".png";
                cardSkin.src = prefixUrl + "skin/" + skinS[Math.floor(i / (flipCounter / 3))] + ".png";

                img.appendChild(cardMouth);
                img.appendChild(cardEyes);
                img.appendChild(cardSkin);

                children.push(img);
                img.onclick = function () { rotateImage(this, flipCounter) };
            }

            shuffle(children);

            for (const child of children) {
                values.board.appendChild(child);
            }

            playGame((cards * 2) + extraCards, complex);
        }

        async function rotateImage(image, flipCounter) {
            console.log(state.currentPoints);
            state.totalFlips++;
            state.currentPoints--;
            var nodes = image.childNodes;
            for (let i = 0; i < nodes.length; i++) {
                if (nodes[i].nodeName.toLowerCase() == 'img') {
                    nodes[i].style.visibility = "visible";
                    visibleNodes.push(nodes[i]);
                    rotateCounter++;
                }
            }

            flippedCard.push(image);
            eyesToCheck.push(image.style.eyes);

            if (rotateCounter == flipCounter) {
                if (eyesToCheck.every((val, i, eyesToCheck) => val === eyesToCheck[0])) {
                    console.log("Same Cards");
                    state.currentPoints += 5;
                    state.flippedCards += (flipCounter / 3);
                    nonClickeable(flipCounter);

                } else {
                    const wait = await timeStop(1000);
                    for (let i = 0; i < visibleNodes.length; i++) {
                        visibleNodes[i].style.visibility = "hidden";
                    }
                }

                visibleNodes = [];
                flippedCard = [];
                eyesToCheck = [];
                rotateCounter = 0;
            }
        }

        function timeStop(time) {
            return new Promise(resolve => {
                setTimeout(() => {
                    resolve('resolved');
                }, time);
            });
        }

        function highscoreAlert() {
            if (httpRequestHighscore.readyState == 4) {
                if (httpRequestHighscore.status == 200) {
                    currentHighscore = httpRequestHighscore.responseText;
                    console.log("Highscore -> " + currentHighscore);
                }
            }
        }

        function highscore() {
            var postdata = 'action=highscore';
            httpRequestHighscore = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP");
            httpRequestHighscore.onreadystatechange = highscoreAlert;
            httpRequestHighscore.open('POST', '../php/pairs.php', true);
            httpRequestHighscore.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequestHighscore.send(postdata);
        }

        function playGame(cards, complex) {
            var flag = false;
            highscore();
            findUser();
            var tries = 0;

            if (complex == true) {
                tries = 80;
            } else {
                tries = 30;
            }

            state.loop = setInterval(() => {
                state.totalTime++
                state.currentPoints--;
                values.moves.innerText = `${state.totalFlips} moves`
                values.timer.innerText = `time: ${state.totalTime} sec`
                var background = document.getElementById('background');

                if (state.currentPoints > currentHighscore && flag == false && complex == true) {
                    flag = true;
                    background.style.backgroundColor = 'goldenrod';
                    setTimeout(function () {
                        background.style.backgroundColor = 'grey';
                    }, 1000)
                }

                if (state.flippedCards == cards) {
                    setEnding('Won!', complex);
                }

                if (state.totalFlips == tries) {
                    state.currentPoints = 0;
                    setEnding('Lost :(', complex);
                }
            }, 1000)
        }

        async function setEnding(message, complex) {

            values.win.innerHTML = `
                            <span class="win-text">
                                You ${message}<br />
                                    with <span class="highlight">${state.currentPoints}</span> points
                            </span> 
                            `

            clearInterval(state.loop);

            setTimeout(function () {
                values.win.innerHTML = '';
            }, 5000);

            const wait = await timeStop(5000);

            if (getCookie("username") != null) {
                endingOptions(complex);
            }
        }

        function endingOptions(complex) {
            levelPoints.push(state.currentPoints);
            console.log(levelPoints);
            complexGameIndex++;
            document.getElementById('board').style.display = "none";
            if (complexGameIndex === 3 || complex == false || state.currentPoints == 0) {
                document.getElementById('submit').style.display = "inline-block";
                document.getElementById('startAgain').style.display = "inline-block";
            }
            if (complex == true && state.currentPoints > 0 && complexGameIndex < 3) {
                document.getElementById('nextGame').style.display = "inline-block";
            }
        }

        //------------------------------------------------------------------------------
        // Post 
        //------------------------------------------------------------------------------

        var httpRequest;
        function scoreAlert() {
            if (httpRequest.readyState == 4) {
                if (httpRequest.status == 200) {
                    var restxt = httpRequest.responseText;
                    console.log(restxt);
                }
            }
        }

        var sum = 0;

        function updateScore() {

            if (levelPoints.length === 1) {
                sum = state.currentPoints;
                levelPoints[0] = 0;
                levelPoints[1] = 0;
                levelPoints[2] = 0;
            } else {
                sum = levelPoints[0] + levelPoints[1] + levelPoints[2];
            }

            if (userFound != 1) {
                console.log(userFound);
                var postdata = `action=updatescores&points=${sum}&lvl1=${levelPoints[0]}&lvl2=${levelPoints[1]}&lvl3=${levelPoints[2]}`;
                httpRequest = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP");
                httpRequest.open("POST", '../php/pairs.php', false);
                httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                httpRequest.send(postdata);
                levelPoints.length = 0;
            } else {
                changeScore();
            }

            reload();
        }

        var httpRequestUser;
        function findUserAlert() {
            if (httpRequestUser.readyState == 4) {
                if (httpRequestUser.status == 200) {
                    userFound = httpRequestUser.responseText;
                }
            }
        }

        function findUser() {
            var postdata = `action=findUser`;
            httpRequestUser = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP");
            httpRequestUser.onreadystatechange = findUserAlert;
            httpRequestUser.open("POST", '../php/pairs.php', true);
            httpRequestUser.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequestUser.send(postdata);
        }

        function changeScore() {
            var postdata = `action=changeScore&points=${sum}&lvl1=${levelPoints[0]}&lvl2=${levelPoints[1]}&lvl3=${levelPoints[2]}`;
            httpRequest = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP");
            httpRequest.open('POST', '../php/pairs.php', false);
            httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequest.send(postdata);
            levelPoints.length = 0;
        }

        function leaderboardNames() {
            var postdata = 'action=leaderboardNames';
            httpRequest = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP");
            httpRequest.onreadystatechange = scoreAlert;
            httpRequest.open('POST', '../php/pairs.php', true);
            httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequest.send(postdata);
        }

        function leaderboardScores() {
            var postdata = 'action=leaderboardScores';
            httpRequest = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP");
            httpRequest.onreadystatechange = scoreAlert;
            httpRequest.open('POST', '../php/pairs.php', true);
            httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequest.send(postdata);
        }

    </script>


</body>

</html>