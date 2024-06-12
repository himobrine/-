<?php
class S{
    var  $payload = '1111';
}
$a = new S();
$a_s = serialize($a);
echo $a;
?>