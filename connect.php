<?php
    
    try{    
        $db = new PDO('sqlite:loeff.db');
    } catch (PDOException $e){
        die ('error: ' . $e->getMessage());
    }

?>
