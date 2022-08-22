<?php

class Room {

    private $room;
    
    public function __construct()
    {

    }

    public function uploadRoom()
    {
        $row = 0;
        $this->room = array();
        if (($handle = fopen("room.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);

                $temporary_queue = array();

                for ($c=0; $c < $num; $c++) {
                    array_push($temporary_queue, $data[$c]);
                }
                $this->room[$row] = $temporary_queue;

                $row++;
            }
            fclose($handle);
        }
    }

    public function addBulb()
    {
        foreach ($this->room as $x => $row_x) {
            foreach ($row_x as $y => $row_y) {

                if($this->room[$x][$y] == 0)
                {
                    if($this->room[$x-1][$y-1] != '+')
                    {
                        $this->room[$x][$y] = '+';

                        if ($this->searchBulb($x,$y)) 
                        {

                            $this->room[$x][$y] = '0';
                        }
                    }
                }
            }
        }
    }

    public function getRoom()
    {
        return $this->room;
    }

    public function searchBulb($x = null, $y = null)
    {

        $add_bulbs_x = 0;
        $add_bulbs_y = 0;
        $newRoom = $this->room;

        for ($i_x=$x; $i_x >= 0 ; $i_x--) { //x
            //echo $newRoom[$i_x][$y]; echo "<br>";

            if($newRoom[$i_x][$y] == '+'){
                $add_bulbs_x++;
            }

        }
        
        
        for ($i_y=$y; $i_y >= 0 ; $i_y--) { // y
            //echo $newRoom[$x][$i_y];
            if($newRoom[$x][$i_y] == '+'){
                $add_bulbs_y++;
            }
        }



        if($add_bulbs_x > 1 || $add_bulbs_y > 1)
        {
            return true;
        }

        return false;
    }
    
}