<?php include('./header.php'); ?>
  <h1>管理画面</h1>
  <a href="./index.php">もどる</a>
  <hr/>
  <?php
  try{
    $dbh = new PDO('sqlite:blog.db','','');   //PDOクラスのオブジェクトの作成
    $sth = $dbh->prepare("select * from posts order by id desc");   //prepareメソッドでSQL文の準備
    $sth->execute();   //準備したSQL文の実行
    while ($row = $sth->fetch()) {
      //テーブルの内容を１行ずつ処理
      $time = preg_split("/[\s.:-]+/",$row['date']);
      echo '<strong>'.$row['title'].'</strong><small>('.$time[0]."年".$time[1]."月". $time[2]."日 ".$time[3].":".$time[4].')</small>';
      echo $row['name'].'<br>';
      echo $row['contents'].'<br>';
      echo "<form action='adminDelete.php' method='post'>";
      echo "<input type='submit' value='削除' class='sbt'/>";
      echo "<input type='hidden' name='id' value=".$row['id'].">";
      echo "</form>";
      echo '<hr/>';
    }
  } Catch (PDOException $e) {
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }
  ?>
<?php include('./footer.php'); ?>
