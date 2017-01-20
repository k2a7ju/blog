<?php include('./header.php'); ?>
<h1>ブログ記事の検索</h1>
<?php
if(isset($_POST["word"])){
  try{
    $word = $_POST["word"];
    $dbh = new PDO('sqlite:blog.db','','');
    $sql="select * from posts where contents like '%".$word."%' or title like '%".$word."%'";
    $sth = $dbh->query($sql);
    $sth -> execute();
  } Catch (PDOException $e) {
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }
  $dbh = null;
}
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
  <ul>
    <label>検索フォーム</label>
    <li>
      <input type="text" name="word" size="60" />
      <input type="submit" value="検索" class='sbt'/>
    </li>
  </ul>
</form>
<?php
if(isset($_POST["word"])){
  while ($row = $sth->fetch()) {
    $time = preg_split("/[\s.:-]+/",$row['date']);
    ?>
    <h1><?php echo $row['title'] ?><small>(<?php echo $time[0]."年".$time[1]."月". $time[2]."日 ".$time[3].":".$time[4] ?>)</small></h1>
    <div class='text'>
      <div>
        <?php echo nl2br($row['contents']) ?><br>
      </div>
    </div>
    <?php
  }
}
?>
<?php include('./footer.php'); ?>
