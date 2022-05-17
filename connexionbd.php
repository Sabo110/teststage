<?php
try{
    $pdo= new pdo('mysql:host=localhost;dbname=utilisateur','root','');
 }
 catch(pdoexception $e){
     echo 'erreur de connexion';
 }


    

?>