<?
ini_set('display_errors','off'); 
// name age
$name = $_POST['name'];
$age = $_POST['age'];

// if($name == '' || $age == ''){
//     echo '0';
//     exit;
// }
// if(is_numeric($age)){
//     echo '0';
//     exit;
// }
// if($age < 18){
//     echo '0';
//     exit;
// }
// if(mb_strlen($name) > 100 ){
//     echo '0';
//     exit;
// }

$rtn_arr = [
    'status'=> true,
    'msg'=>''
];

if( $name == '' || $age == '' ){
    $rtn_arr['status'] = false;
    $rtn_arr['msg'] = '建立失敗:名稱或年齡不可為空';
    echo json_encode($rtn_arr,JSON_UNESCAPED_UNICODE);
    exit;
}else{
    $rtn_arr['msg'] = '建立成功';
    echo json_encode($rtn_arr,JSON_UNESCAPED_UNICODE);
    exit;
}
?>