<?php
if (@$_POST['action'] == 'leaderboardNames') {
    $json = file_get_contents("../leaderboard.json");
    $jsonData = json_decode($json, true);

    $names = [];
    $index = 0;

    foreach ($jsonData as $item) {
        array_push($names, $jsonData[$index]['username']);
        $index++;
    }
    return $names;
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
?>