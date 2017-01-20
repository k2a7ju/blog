<?php include('./header.php'); ?>
	<h1>コメント投稿</h1>
	<?php
	try{
		ini_set("date.timezone", "Asia/Tokyo");
		$time = date("Y.m.d-H:i");
		$contents = $_POST["contents"];
		$pid = $_POST["pid"];
		$dbh = new PDO("sqlite:blog.db"," "," ");
		$sql = "insert into comments(pid,contents,date) values(?,?,?)";
		$sth = $dbh->prepare($sql);
		$sth->execute(array($pid,$contents,$time));
		if($sth){
			echo "コメント投稿に成功しました";
		}else{
			echo "コメント投稿に失敗しました";
		}
	}Catch(PDOException $e){
		echo "エラー";
	}
	?>
	<a href="index.php">blog閲覧ページへのリンク</a>
<?php include('./footer.php'); ?>
