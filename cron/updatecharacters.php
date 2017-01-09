<?php

    $db = DBOpen();
    //calculate the update time from the now function
    //86400 = 1 day in seconds
    $update = time() - 86400;
    $roundMode = PHP_ROUND_HALF_UP;
    //Get all pilots from the Pilot table, and update each one.
    $pilots = $db->fetchRowMany('SELECT * FROM Pilots WHERE lastUpdate< :update', array('update' => $update));
    //Get how many loops we will need
    $numofPilots = sizeof($pilots);
    $loops = ceil($numOfPilots / 100 );
    
    for($i = 0; $i < $loops; $i++) {
        $innerLoopStart = $i * 100;
        $innerLoopStop = $innerLoopStart + 100;
        //Setup the call and then use the loop to add pilots to the call
        $apiCallStart = "http://kos.cva-eve.org/api/?icon=32&max=100&c=json&q=";
        $apiCallEnd = "&offset=0&type=multi";
        for($j = $innerLoopStart; $j < $innerLoopStop; $j++) {
            //Get the pilot's name, and replace the spaces.
            $pilot = str_replace(" ", "+", $pilots[$j]['label']);
            //Add the pilot to the api call
            $apiCallStart = $apiCallStart . $pilot . ",";
        }
        //Add the ending to the api call
        $apiCall = $apiCallStart + $apiCallEnd;
        $jsonData = file_get_contents($apiCall);
        //Process the contents
        $results = $jsonData->results;
        //Loop through results and add the database
        foreach($results as $result) {
            //Update the time
            $lastUpdate = time();
            
            $pilot = array(
                'id' => $result['id'],
                'label' => $result['label'],
                'icon' => $result['icon'],
                'kos' => $result['kos'],
                'eveid' => $result['eveid'],
                'lastUpdate' => $lastUpdate
            );

            $corp = array(
                'id' => $result['corp']['id'],
                'label' => $result['corp']['label'],
                'icon'=> $result['corp']['icon'],
                'kos' => $result['corp']['kos'],
                'eveid' => $result['corp']['eveid'],
                'ticker' => $result['corp']['ticker'],
                'npc' => $result['corp']['npc'],
                'lastUpdate' => $lastUpdate
            );

            $alliance = array(
                'id' => $result['corp']['alliance']['id'],
                'label' => $result['corp']['alliance']['label'],
                'icon' => $result['corp']['alliance']['icon'],
                'kos' => $result['corp']['alliance']['kos'],
                'eveid' => $result['corp']['alliance']['kos'],
                'ticker' => $result['corp']['alliance']['ticker'],
                'lastUpdate' => $lastUpdate
            );
            //Replace the entry in the database.
            $db->replace('Pilot', $pilot);
            $db->replace('Corp', $corp);
            $db->replace('Alliance', $alliance);
            
        }
    }
    
    DBClose($db);