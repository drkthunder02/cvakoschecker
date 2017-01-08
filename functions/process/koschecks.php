<?php

function KOSChecks($names) {
    //Size of the $names array
    $size = sizeof($names);
    //Declare the types of checks made
    /*
     * 'redis' = found and expired
     * 'cva' = true or false
     */
    $checks = array();
    //Declare redis connection
    $redis = new Predis\Client();
    
    //Check Redis for each pilot, and update the 
    for($i = 0; $i < $size; $i++) {
        //Check each of $names for pilot in Redis
        $redisKey = $names[$i];
        
    }
    
    //Results should be an array('pilot', 'corp', 'alliance', 'kos')
    return $results;
}