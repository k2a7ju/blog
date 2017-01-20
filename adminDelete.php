<?php
  try{
    $id = $_POST['id'];
    $dbh = new PDO('sqlite:blog.db','','');   //PDOクラスのオブジェクトの作成
    $sql = "delete from posts where id = '$id'";
    $sth = $dbh->prepare($sql);   //prepareメソッドでSQL文の準備
    $sth->execute();   //準備したSQL文の実行
    $login_url = "http:./admin.php";
    header("location: {$login_url}");
    exit();
  } Catch (PDOException $e) {
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }
?>
