<?php
    
    try{    
        $pdo = new PDO('sqlite:loeff.db');
        $_SESSION['PDO'] = $pdo;
    } catch (PDOException $e){
        die ('error: ' . $e->getMessage());
    }

?>