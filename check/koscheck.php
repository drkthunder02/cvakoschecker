<?php
    //Start the session from saved data
    $session = new Custom\Sessions\sessions();
    //Connect to the redis database
    $redis = new Predis\Client();
    //Initialize 
    $foundInRedis = array();
    $namesArray = array();
    $foundInSql = array();
    $results = array();
    $kos = array();
    $pos = 0;
    $cvaQuery = false;
    
    
    //Get the data from CVA's site, set the session state
    if(isset($_POST["names"])) {
        $names = filter_input($_POST, "names", FILTER_SANITIZE_SPECIAL_CHARS);
        $namesArray = TextAreaToArray($names);
    } else {
        PrintNoNamesFound();
        exit();
    }
    
    $prefix = "http://kos.cva-eve.org/api/?icon=32&max=100&c=json&q=";
    $postfix = "&offset=0&type=multi";
    
    //Check the names array for the names in redis first
    //If the names are not found in redis, then get data from CVA's site
    //If the names are found in Redis print the data, and set the data to be rechecked by the KOS checker
    
    //If the size is too big print out the error page
    $size = sizeof($namesArray);
    if($size > 100) {
        PrintArrayTooBigError();
    }
    
    /*
     * Send text array of names to function
     * Returns an array of names, corporation, alliance (if applicable), and whether they are kos or not
     */
    
    $checkedNamesArray = KOSChecks($namesArray);
?>
 