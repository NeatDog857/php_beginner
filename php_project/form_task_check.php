<?php
    require_once("form_task_db.php");

    $sqlCommand= "SELECT * FROM `shipment_form`";

    $result= $sql->query($sqlCommand);

    // $row= $result->fetch_all(MYSQLI_ASSOC);
   
    // $row= json_encode($row,JSON_UNESCAPED_UNICODE);
    // var_dump($row);


    
    
    
    $options = [];
    
    if($result){
        while ($row = $result->fetch_assoc()){
            $options[] = $row;
        }
    }



    echo json_encode($options, JSON_UNESCAPED_UNICODE);
    $sql->close();