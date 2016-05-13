<?php

function showSearchGames($list) {
    for ($i = 0; $i < count($list); $i++) {
        printGame($list[$i]);
    }
}

function printGame($game) {
    echo $game['Title'];
}
?>