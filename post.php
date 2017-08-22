<?php
$memo_member_id = $_POST['memo_member_id'];
$memo_topic = $_POST['memo_topic'];
$memo_content = $_POST['memo_content'];

// echo $memo_member_id, '<br>';
// echo $memo_topic, '<br>';
// echo $memo_content, '<br>';

// 08-12 檢查空字串
if($memo_member_id=='' || $memo_topic == '' || $memo_content==''){
	header("Location: memo_error_msg.php?error_code=1");
	exit;
}

$options = array(
	PDO::ATTR_EMULATE_PREPARES => false, 
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$db = new PDO('mysql:host=localhost:3306;dbname=family;charset=utf8',
	'root', '1234', $options);

if(!isset($_POST['reply_to_memo_id'])){
	$stmt = $db->prepare(
		"INSERT INTO memo (memo_member_id, memo_topic, memo_content, memo_type) VALUES
			(:pauthor, :ptopic, :pcontent, :ptype)");
	$stmt->execute(
		array(
			':pauthor' => $memo_member_id,
			':ptopic' => $memo_topic,
			':pcontent' => $memo_content,
			':ptype' => TRUE
			));
}else{
	$stmt = $db->prepare(
		"INSERT INTO memo (memo_member_id, memo_topic, memo_content, memo_type, reply_to_memo_id) VALUES
			(:pauthor, :ptopic, :pcontent, :ptype, :rpid)");
	$stmt->execute(
		array(
			':pauthor' => $memo_member_id,
			':ptopic' => $memo_topic,
			':pcontent' => $memo_content,
			':ptype' => False,
			':rpid' => $_POST['reply_to_memo_id']
			));
}

header('Location: memo.php');
?>