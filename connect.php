<?php
    
    try{    
        $pdo = new PDO('sqlite:test.db');
        $_SESSION['PDO'] = $pdo;
    } catch (PDOException $e){
        die ('error: ' . $e->getMessage());
    }

?>
