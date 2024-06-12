<?php  
// 启动会话  
session_start();  
  
// 检查 OpenSSL 扩展是否可用  
if (!function_exists('openssl_random_pseudo_bytes')) {  
    die('OpenSSL 扩展未启用。');  
}  
  
// 生成一个随机的 256 位（32 字节）令牌  
$randomBytes = openssl_random_pseudo_bytes(32);  
if ($randomBytes === false) {  
    die('无法生成随机字节。');  
}  
  
// 将随机字节转换为十六进制字符串  
$token = bin2hex($randomBytes);  
  
// 将令牌存储在会话中  
$_SESSION['valid_token'] = $token;  
  
// 在这里可以添加其他逻辑，例如输出令牌或将其用于身份验证  
  
// ...  
  
// 确保在脚本结束前关闭会话（尽管 PHP 会在脚本结束时自动关闭会话）  
session_write_close();  
?>