<?php

namespace App\Models;

class MainModel
{
    public static function sortEqual(Array $numset): Array {
        $count = floor(count($numset)/2);
        //get equal bucket width 
        $set = (max($numset) - min($numset)) / $count;
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

    public static function sortFrequency(Array $numset): Array {
            $count = floor(count($numset)/2);
            //determine frequency group size
            $group = ceil(count($numset) / $count);
            sort($numset);

            for ($i = 0; $i < $count; $i++) {
                //start position in array
                $start = $i * $group;
                //end position in array
                $end = ($i + 1) * $group - 1;
                //have we reached end
                $end = min($end, count($numset) - 1);
                //determine number values in this set
                $length = $end - $start + 1;
                $values = array_slice($numset, $start, $length);
                if(!empty($values)) {
                    $sorted_set[($i + 1)] = $values;
                }
            }
        
            return $sorted_set;
    }
}