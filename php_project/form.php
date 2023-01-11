<?php
    //ini_set('display_errors','off');



    $name= $_POST["name"];
    $age= $_POST["age"];
    $cell= $_POST["cell"];
    $address= $_POST["address"];
    $email= $_POST["email"];
    $date= $_POST["date"];
    $annoying= $_POST["annoying"];

    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($name)){
            echo "姓名為必填<br/>";
        }
        if(empty($age)){
            echo "年齡為必填<br/>";
        }
        if(empty($cell)){
            echo "手機為必填<br/>";
        }
        if(empty($address)){
            echo "地址為必填<br/>";
        }
        if(empty($date)){
            echo "寄送日期為必填<br/>";
        }
        if($annoying=="on"){
            echo "煩死人不償命<br/>";
        }
    }