<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        http://kos.cva-eve.org/api/?icon=32&max=100&c=json&q=Minerva+Arbosa&offset=0&type=multi
        ?>
    </body>
</html>

<?php
    //Load the registry to get files for classes and functions
    require_once 'functions/registry.php';
    //Start the session
    $session = new Custom\Sessions\sessions();
    
    //Print out Navigation Bar
    PrintNavBar();
    
    PrintTextAreaForm();
    
    

?>
