<?php 
header('Content-type:text/html;charset=utf-8');
class Demo { 
    private $file = 'index.php';
    public function __construct($file) { 
        $this->file = $file; 
    }
    function __destruct() { 
        echo @highlight_file($this->file, true);
    }
}
if (isset($_GET['var'])) { 
    //do you know flag is here?
    $var = Urldecode($_GET['var']); 
    if (preg_match('/[o]:/', $var)) { 
        die('欸欸欸，搞什么！'); 
    } else {
        @unserialize($var); 
    } 
} else { 
    highlight_file("index.php"); 
} 
?>
