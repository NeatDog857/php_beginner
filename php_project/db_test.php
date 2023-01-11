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
    // 新增選項
    // $name = $_POST['option_name'];
    // $name = 'test';
    // $description = 'test';
    // $status = 0;
    // $sql="INSERT INTO `vote_options` (`name`, `description`,`status`) VALUES ( '$name', '$description',$status);";
    // $result = $conn->query($sql);
    // if($result){
    //     echo "成功";
    // }else{
    //     echo "失敗";
    // }

    
    // 取得投票選項
    $sql = "SELECT `id`,`name` FROM `vote_options` WHERE `status` = 1";
    $result = $conn->query($sql);
    $options = [];
    if($result){
        while ($row = $result->fetch_assoc()){
            $options[] = $row;
        }
    }
    echo json_encode($options, JSON_UNESCAPED_UNICODE);

// 投票
// 票須記名
// 一人三票
// 投票項目
// 計票箱


