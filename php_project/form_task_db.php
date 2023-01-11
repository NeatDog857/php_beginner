<?php
    $serverName="localhost";
    $userName="root";
    $password="";
    $dbName="shipment";

    $sql= new mysqli($serverName,$userName,$password,$dbName);

    if(!empty($sql->connect_error)){
        die("failed to connect to server: ". $sql->connect_error);
    }