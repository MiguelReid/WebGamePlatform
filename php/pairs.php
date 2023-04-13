<?php

if (@$_POST['action'] == 'updatescores') {

    $name = $_COOKIE['username'];
    $points = $_POST['points'];

    $jsonData = '{
        "username":"' . $name . '",
        "points":' . $points . '
    }';

    $json = file_get_contents("../leaderboard.json");

    if (empty($json)) {
        $json = '[' . $json;
    } else {
        $json = rtrim($json, "]");
        $json = $json . ',';
    }

    $testArray = $json . $jsonData . ']';
    print_r($testArray);
    file_put_contents("../leaderboard.json", $testArray);
}

if (@$_POST['action'] == 'retrievescores') {
    $json = file_get_contents("../leaderboard.json");
    $jsonData = json_decode($json, true);

    $star = "FUNCIONA";
    $index = 0;

    foreach ($jsonData as $item) {
        if ($item['username'] == $star) {
            $jsonData[$index]['username'] = "shakira";
        }
        $index++;
    }

    $json_object = json_encode($jsonData, true);
    file_put_contents('../leaderboard.json', $json_object);
}

if (@$_POST['action'] == 'leaderboardNames') {
    $json = file_get_contents("../leaderboard.json");
    $jsonData = json_decode($json, true);

    $names = [];
    $index = 0;

    foreach ($jsonData as $item) {
        array_push($names, $jsonData[$index]['username']);
        $index++;
    }
    print_r($names);
}

if (@$_POST['action'] == 'leaderboardScores') {
    $json = file_get_contents("../leaderboard.json");
    $jsonData = json_decode($json, true);

    $scores = [];
    $index = 0;

    foreach ($jsonData as $item) {
        array_push($scores, $jsonData[$index]['points']);
        $index++;
    }
    print_r($scores);
}

if (@$_POST['action'] == 'highscores') {
    $json = file_get_contents("../leaderboard.json");
    $jsonData = json_decode($json, true);

    $index = 0;
    $highscore = 0;

    foreach ($jsonData as $item) {
        if ($jsonData[$index]['points'] > $highscore) {
            $highscore = $jsonData[$index]['points'];
        }
        $index++;
    }
    echo ($highscore);
}

?>