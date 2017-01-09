<?php

function KOSChecks($names) {
    //Size of the $names array
    $namesSize = sizeof($names);
    
    //Declare the types of checks made
    /*
     * 'redis' = found and expired
     * 'cva' = true or false
     */
    $checks = array();
    //Declare redis variable
    $redis = new Redis();
    $cvaList = "http://kos.cva-eve.org/api/?icon=32&max=100&c=json&q=";
    $cvaListEnd = "&offset=0&type=multi";
    
    //Check Redis for each pilot, and update the 
    for($i = 0; $i < $namesSize; $i++) {
        //Check each of $names for pilot in Redis
        $redisKey = $names[$i];
        $redisData = $redis->hGetAll($redisKey);
        if($tempData == NIL) {
            $results[$i]['label'] = $names[$i];
            $cvaList = AddToCVAList($names[$i], $cvaList);
        } else {
            $results[$i]['pilot'] = $redisData['pilot'];
            $results[$i]['corp'] = $redisData['corp'];
            $results[$i]['alliance'] = $redisData['alliance'];
            $results[$i]['kos'] = $redisData['kos'];
            $results[$i]['process'] = 'complete';
        }
    }
    //Build the CVA string for the API Call
    $cvaList = $cvaList . $cvaListEnd;
    $jsonData = file_get_contents($cvaList);
    $cvaResults = $jsonData->results;
    $jsonSize = sizeof($cvaResults);
    //Add the CVA API calls data to the array to send back to calling function
    for($i = 0; $i < $jsonSize; $i++) {
        $pilot = array(
            'id' => $cvaResults[$i]['id'],
            'label' => $cvaResults[$i]['label'],
            'icon' => $cvaResults[$i]['icon'],
            'kos' => $cvaResults[$i]['kos'],
            'eveid' => $cvaResults[$i]['eveid']
        );
        
        $corp = array(
            'id' => $cvaResults[$i]['corp']['id'],
            'label' => $cvaResults[$i]['corp']['label'],
            'icon'=> $cvaResults[$i]['corp']['icon'],
            'kos' => $cvaResults[$i]['corp']['kos'],
            'eveid' => $cvaResults[$i]['corp']['eveid'],
            'ticker' => $cvaResults[$i]['corp']['ticker'],
            'npc' => $cvaResults[$i]['corp']['npc']
        );
        
        $alliance = array(
            'id' => $cvaResults[$i]['corp']['alliance']['id'],
            'label' => $cvaResults[$i]['corp']['alliance']['label'],
            'icon' => $cvaResults[$i]['corp']['alliance']['icon'],
            'kos' => $cvaResults[$i]['corp']['alliance']['kos'],
            'eveid' => $cvaResults[$i]['corp']['alliance']['kos'],
            'ticker' => $cvaResults[$i]['corp']['alliance']['ticker']
        );
        
        
        //If the name matches the correct spot in the results list, add the info as necessary
        //Once the info is added, add a redis entry, and set expiry, and insert any new entries into the sql database for storage
        
        
        for($j = 0; $j < $namesSize; $j++) {
            if($results[$j]['label'] == $pilot['label']) {
                $results[$j]['pilot'] = $pilot['label'];
                $results[$j]['corp'] = $corp['label'];
                $results[$j]['alliance'] = $alliance['label'];
                if(($pilot['kos'] OR $corp['kos'] OR $alliance['kos]']) == true) {
                    $names[$j]['kos'] = true;
                } else {
                    $names[$j]['kos'] = false; 
                }
                
                //Add the entry into redis
                $redis->hSet($names[$j]['label'], "pilot", $results[$j]['pilot']);
                $redis->hSet($names[$j]['label'], "corp", $results[$j]['corp']);
                $redis->hSet($names[$j]['label'], "alliance", $results[$j]['alliance']);
                $redis->hSet($names[$j]['label'], "kos", $results[$j]['kos']);
                $redis->expire($names[$j]['label'], "3600");
                
                //Open the database and store the items in the database as well
                $db = DBOpen();
                $now = time();
                $db->replace('Pilot', array('eveid' => $pilot['eveid'],
                                            'label' => $pilot['label'],
                                            'icon' => $pilot['icon'],
                                            'kos' => $pilot['kos'],
                                            'lastUpdate' => $now));
                $db->replace('Corp', array('eveid' => $corp['eveid'],
                                            'label' => $corp['label'],
                                            'icon' => $corp['icon'],
                                            'kos' => $corp['kos'],
                                            'ticker' => $corp['ticker'],
                                            'npc' => $corp['npc'],
                                            'lastUpdate' => $now));
                $db->replace('Alliance', array('eveid' => $alliance['eveid'],
                                                'label' => $alliance['label'],
                                                'icon' => $alliance['icon'],
                                                'kos' => $alliance['kos'],
                                                'ticker' => $alliance['ticker'],
                                                'lastUpdate' => $now));
                //Close the database connection
                DBClose($db);
            }
        }
        
        
    }
    
    
    //Results should be an array('pilot', 'corp', 'alliance', 'kos')
    return $results;
}