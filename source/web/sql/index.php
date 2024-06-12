<?php    
session_start();    
$_SESSION['allowed_from_index'] = true;    
$failedAttemptsThreshold = 150;      
  
if (!isset($_SESSION['failedAttempts'])) {    
    $_SESSION['failedAttempts'] = 0;    
}      
  
$servername = "localhost";    
$username = "root";    
$password = "root";    
$dbname = "sqlinjection";    
$conn = new mysqli($servername, $username, $password, $dbname);    
if ($conn->connect_error) {    
    die("连接失败: " . $conn->connect_error);    
}    
$usernameInput = isset($_POST['username']) ? $_POST['username'] : '';    
$passwordInput = isset($_POST['password']) ? $_POST['password'] : '';     

$sql = "SELECT * FROM user WHERE username='$usernameInput' AND password='$passwordInput'";    
$result = $conn->query($sql);    
if ($result === false) {    
    die("查询失败: " . $conn->error);    
}    
if ($result->num_rows > 0) {    
    $_SESSION['logged_in'] = true;   
    $_SESSION['valid_token'] = bin2hex(openssl_random_pseudo_bytes(16));    
    unset($_SESSION['failedAttempts']); 
    echo "True"; 
    $sql = "SELECT * FROM user WHERE id = 1'";
    $result1 = $conn->query($sql);
    // if()
    // header("Location: flag.php?token=" . $_SESSION['valid_token']);
    exit;  
} else {    
    $_SESSION['failedAttempts']++;    
    if ($_SESSION['failedAttempts'] >= $failedAttemptsThreshold) {    
        unset($_SESSION['failedAttempts']); 
        $strs="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
        $username_data=substr(str_shuffle($strs),mt_rand(0,strlen($strs)-11),5);
        $password_data=substr(str_shuffle($strs),mt_rand(0,strlen($strs)-11),5);
        // echo $username_data; 
        $sql = "update user set username = '$username_data' where id =1;";
        $conn->query($sql);
        $sql = "update user set password = '$password_data' where id =1;";
        $conn->query($sql);
        header("Location: 404.php");   
        exit;   
    } else {    
        echo "你还有 " . ($failedAttemptsThreshold - $_SESSION['failedAttempts']) . " 次尝试机会。";    
    }    
}    
  
$result->free(); 
$conn->close();   
?>     
<!DOCTYPE html>    
<html lang="en">    
<head>    
    <meta charset="UTF-8">    
    <title>来吧，展示</title>    
</head>    
<body>    
    <form method="post" action="">    
        <label for="username">用户名:</label>    
        <input type="text" id="username" name="username" required><br>    
        <label for="password">密码:</label>    
        <input type="password" id="password" name="password" required><br>    
        <input type="submit" value="登录">    
    </form>    
</body>    
</html>