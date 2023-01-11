<?
$server_name = 'localhost';
$username = 'root';
$password = '';
$db_name = 'vote';

// mysqli 的四個參數分別為：伺服器名稱、帳號、密碼、資料庫名稱
$conn = new mysqli($server_name, $username, $password, $db_name);


if (!empty($conn->connect_error)) {
    die('資料庫連線錯誤:' . $conn->connect_error);    // die()：終止程序
}

$id = $_POST['id'];
// $sql = "SELECT `name` FROM `vote_options` WHERE `id` = $id";
// $result = $conn->query($sql);
// if($result){
//     while ($row = $result->fetch_assoc()){
//         var_dump($row['name']);
//     }
// }
$membr_id = 1;
$sql = "SELECT COUNT(`member`) FROM `vote_result` WHERE `member` = $membr_id";
$result = $conn->query($sql);
if($result){
    while ($row = $result->fetch_assoc()){
        if($row['COUNT(`member`)']>=3){
            die("超過三票");
        }
    }
}else{
    die("失敗");
}
$sql = "INSERT INTO `vote_result` (`vote_option`,`member`) VALUES ($id,$membr_id)";
$result = $conn->query($sql);
if($result){
    die("成功");
}else{
    die("失敗");
}
