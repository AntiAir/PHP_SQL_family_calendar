<?php
if( isset($_GET['page_num']) ){
	$page_num = $_GET['page_num'];
}else{
	$page_num = 0;
}
$memo_per_page = 2;
$options = array(
	PDO::ATTR_EMULATE_PREPARES => false, 
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$db = new PDO('mysql:host=localhost:3306;dbname=forum;charset=utf8',
	'root', '1234', $options);
$stmt = $db->prepare("SELECT * from memo WHERE memo_type=TRUE ORDER BY memo_id DESC LIMIT :start, :length");
$stmt->execute(array(
		':start' => $memo_per_page*$page_num,
		':length' => $memo_per_page
	));
$memos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		html, body{
			margin: 0;
			padding: 0;
		}
		.container{
			width: 500px;
			margin: auto;
		}
		.memo-group{
			border: 1px lightgrey solid;
			padding: 30px;
		}
		.memo{
			border-bottom: 1px lightgrey solid;
		}
		.page-numbers{
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container">
		<?php
		foreach($memos as $memo){
		?>

		<div class="memo-group">
			<div class="memo">
			主題：<?php echo htmlspecialchars($memo['memo_topic'],ENT_QUOTES); ?><br>
			作者：<?php echo htmlspecialchars($memo['memo_author'], ENT_QUOTES); ?><br>
			時間：<?php echo $memo['memo_time']; ?><br>
			內文：<br>
			<?php echo nl2br(htmlspecialchars($memo['memo_content'],ENT_QUOTES)); ?>
			</div>

			<?php
			$stmt = $db->prepare("SELECT * FROM memo WHERE reply_to_memo_id=:rpid AND memo_type=:ptype ORDER BY memo_id ASC");
			$stmt->execute(
			array(
				':rpid' => $memo['memo_id'],
				':ptype' => False));

			$replies = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($replies as $reply){
			?>
			<div class="memo">
				主題：<?php echo htmlspecialchars($reply['memo_topic'], ENT_QUOTES); ?><br>
				作者：<?php echo htmlspecialchars($reply['memo_author'], ENT_QUOTES); ?><br>
				時間：<?php echo $reply['memo_time']; ?><br>
				內文：<br>
				<?php echo nl2br(htmlspecialchars($reply['memo_content'], ENT_QUOTES)); ?>
			</div>
			<?php
			}
			?>

			<form action="post.php" method="POST">
				暱稱：<input type="text" name="memo_author"><br>
				標題：<input type="text" name="memo_topic"><br>
				內文：<br>
				<textarea name="memo_content"></textarea>
				<input type="hidden" name="reply_to_memo_id" value="<?php echo $memo['memo_id']; ?>">
				<input type="submit" value="PO文">
			</form>
		</div>
		<?php
		}
		?>

		<form action="post.php" method="POST">
			暱稱：<input type="text" name="memo_author"><br>
			標題：<input type="text" name="memo_topic"><br>
			內文：<br>
			<textarea name="memo_content"></textarea>
			<input type="submit" value="PO文">
		</form>

		<div class="page-numbers">
		<?php
		$stmt = $db->query("SELECT * FROM memo WHERE memo_type=TRUE");
		$rcount = $stmt->rowCount();
		$total_page_num = ceil($rcount / $memo_per_page);
		for($i=0; $i<$total_page_num; $i++){
			if($i != $page_num){
				echo "<a href=\"index.php?page_num=$i\">", $i+1,"</a>\n";
			}else{
				echo $i+1, "\n";
			}
		}
		?>
		</div>
	</div>
</body>
</html>