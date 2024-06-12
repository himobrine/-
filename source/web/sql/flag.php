<!DOCTYPE html>      
<html lang="en">      
<head>      
    <meta charset="UTF-8">      
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <title>你小子牛逼啊</title>      
</head>      
<body>      
<?php    
if($_SERVER['HTTP_REFERER'] == '')
{
    header('Location: tangping.php');    
    exit;  
}
session_start();    
if (!isset($_SESSION['valid_token']) || empty($_SESSION['valid_token'])) {  
    header('Location: tangping.php');    
    exit;  
}  
if (isset($_GET['token'])) {  
    // 检查URL中的token是否与session中的token匹配  
    if ($_GET['token'] !== $_SESSION['valid_token']) {  
        // Token不匹配，跳转到tangping.php  
        header('Location: tangping.php');    
        exit;  
    }  
}  
$flagFile = 'flag.txt';      
if (file_exists($flagFile) && is_readable($flagFile)) {      
    $flagContent = file_get_contents($flagFile);      
    echo nl2br(htmlspecialchars($flagContent));     
} else {      
    echo "无法找到或读取flag文件。";      
}      
?>    
</body>      
</html>