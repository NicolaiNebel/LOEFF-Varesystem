<?php
    
    try{    
        $db = new PDO('sqlite:'.__ROOT__.'/loeff.db');
    } catch (PDOException $e){
        die ('error: ' . $e->getMessage());
    }

?>
