<?php

function showSearchGames($list) {
    for ($i = 0; $i < count($list); $i++) {
        printGame($list[$i]);
    }
}

function printGame($game) {
    //$game['Title']
    echo '
    <div class="row">
        <div class="col-md-6 col-xs-6">
        <span><img src="images/games/'.$game['Title'].'.png" class="img-responsive" style="float:left;" alt="'.$game['Title'].'" width="135px"></span>
        </div>
        <div class="col-md-6 col-xs-6">
        '.$game['Title'].'<br><strong style="color:orange">'.$game['Price'].' €</strong>
        </div>
    </div>
    ';
}
?>