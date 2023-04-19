<?php

if (@$_POST['action'] == 'updatescores') {

    $name = $_COOKIE['username'];
    $lvl1 = $_POST['lvl1'];
    $lvl2 = $_POST['lvl2'];
    $lvl3 = $_POST['lvl3'];
    $points = $_POST['points'];


    $jsonData = '{
        "username":"' . $name . '",
        "lvl1":' . $lvl1 . ',
        "lvl2":' . $lvl2 . ',
        "lvl3":' . $lvl3 . ',
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

if (@$_POST['action'] == 'changeScore') {
    $json = file_get_contents("../leaderboard.json");
    $jsonData = json_decode($json, true);

    $star = $_POST['points'];
    $name = $_COOKIE['username'];
    $index = 0;
    $lvl1 = $_POST['lvl1'];
    $lvl2 = $_POST['lvl2'];
    $lvl3 = $_POST['lvl3'];

    foreach ($jsonData as $item) {
        if ($item['username'] == $name and $star > $jsonData[$index]['points']) {
            $jsonData[$index]['lvl1'] = (int) $lvl1;
            $jsonData[$index]['lvl2'] = (int) $lvl2;
            $jsonData[$index]['lvl3'] = (int) $lvl3;
            $jsonData[$index]['points'] = (int) $star;
            $json_object = json_encode($jsonData, true);
            file_put_contents('../leaderboard.json', $json_object);
        }
        $index++;
    }
}

if (@$_POST['action'] == 'findUser') {
    $json = file_get_contents("../leaderboard.json");
    $jsonData = json_decode($json, true);

    $name = $_COOKIE['username'];
    $index = 0;
    $flag = false;

    foreach ($jsonData as $item) {
        if ($item['username'] == $name) {
            $flag = true;
        }
        $index++;
    }
    echo $flag;
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

if (@$_POST['action'] == 'highscore') {
    $json = file_get_contents("../leaderboard.json");
    $jsonData = json_decode($json, true);

    $index = 0;
    $highscore = 0;

    if (!empty($json)) {
        foreach ($jsonData as $item) {
            if ($jsonData[$index]['points'] > $highscore) {
                $highscore = $jsonData[$index]['points'];
            }
            $index++;
        }
    }
    echo ($highscore);
}

?>