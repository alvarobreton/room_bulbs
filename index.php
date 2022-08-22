<?php

include("class/room.php");

$room = new Room();
$room->uploadRoom();
$room->addBulb();



$newRoom = $room->getRoom();


foreach ($newRoom as $x => $row_x) {
    foreach ($row_x as $y => $row_y) {
        echo $newRoom[$x][$y].','; 
    }
    echo "<br>";
}


//$room->searchBulb(7,1);



