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
    echo json_encode($names);
}

if (@$_POST['action'] == 'leaderboardScores') {
    $json = file_get_contents("../leaderboard.json");
    $jsonData = json_decode($json, true);

    $data = [];
    $index = 0;

    foreach ($jsonData as $item) {
        array_push($data, $jsonData[$index]['username']);
        array_push($data, $jsonData[$index]['points']);
        $index++;
    }
    echo json_encode($data);
}
?>