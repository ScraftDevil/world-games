<?php

function showSearchGames($list) {
    for ($i = 0; $i < count($list); $i++) {
        printGame($list[$i]);
    }
}

function printGame($game) {
    $imgPathCheck = "../../view/resources/images/games/".$game['ID_Game'].".png";
    if (!file_exists($imgPathCheck)) {
        $imgURL = "../resources/images/games/noimage.png";
    } else {
        $imgURL = "../resources/images/games/".$game['ID_Game'].".png";
    }
    echo '<div class="row">
        <div class="col-md-6 col-xs-6">
        <span><a href="../gameViews/gameDetailsView.php?gameid='.$game['ID_Game'].'"><img src="'.$imgURL.'" class="img-responsive" style="float:left;" alt="'.$game['Title'].'" width="135px"></img></a></span>
        </div>
        <div class="col-md-6 col-xs-6">
        '.$game['Title'].'<br><strong style="color:orange">'.$game['Price'].' €</strong>
        </div>
    </div>
    ';
}
?>