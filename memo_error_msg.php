<?php

if( !isset($_GET['error_code']) ){
	header('Location: memo.php');
	exit;
}

$error_code = $_GET['error_code'];

if($error_code == 1){
?>

請填寫所有欄位!!<br>
<a href="memo.php">返回</a>

<?php
}
?>