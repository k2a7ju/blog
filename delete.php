<?php
if (isset($_POST["id"])) {
	if(!isset($_POST["password"])||$_POST["password"]!='abc'){
		echo "<p>パスワードが違います</p>";
	}else{
		try{
			$dbh = new PDO('sqlite:blog.db','','');
			$sql = "delete from posts where id = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($_POST["id"]));
			if ($sth) {
				echo "記事１件を削除しました";
				echo '<a href="index.php">ブログtopへ</a>';
			} else {
				echo "記事１件の削除に失敗しました";

				echo '<a href="index.php">ブログtopへ</a>';
			}

		}Catch(PDOException $e){
			echo "エラー";
		}
		$dbh = null;
	}
}
?>
