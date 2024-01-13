<?php

namespace App\Models;

class MainModel
{
    public static function sortEqual(Array $numset): Array {
        $count = floor(count($numset)/2);
        //get equal bucket width 
        $set = (max($numset) - min($numset)) / $count;
        //get in asc order
        sort($numset); 
        //set initial values;
        $start = 0;
        $end = $set;
        $old_index = 0;
        $max_index = $count - 1;

        foreach ($numset as $num) {
            // find position in buckets
            $position = $num / $set;
            // convert position to a suitable index value
            $index = min(floor($position), $max_index);    
            // update loop values
            if($index != $old_index) {
                $start = $end;
                $end = $end+$set;
                $old_index = $index;
            }
            //format output
            $sorted_set[$index]['bucket']['start'] = $start;
            $sorted_set[$index]['bucket']['end'] = $end;
            $sorted_set[$index]['bucket']['width'] = $set;
            $sorted_set[$index]['numset'][] = $num;    
        }

        return $sorted_set;
    }
}