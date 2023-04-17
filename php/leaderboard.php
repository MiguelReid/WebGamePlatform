<?php

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