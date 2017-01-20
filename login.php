<?php
if (isset($_POST["id"]) && isset($_POST["pass"])) {
  try{
    $id = $_POST["id"];
    $pass = $_POST["pass"];
    $dbh = new PDO('sqlite:blog.db','','');
    $sql="select password from admin where id = '$id'";
    $sth = $dbh->query($sql);
    $sth -> execute();
    $login_url = "http:./admin.php";
    while($row = $sth -> fetch(PDO::FETCH_ASSOC)) {
      if($row['password'] == $pass){
        header("location: {$login_url}");
        exit();
      }
    }
    echo 'ログインに失敗しました。';
  } Catch (PDOException $e) {
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }
}
$dbh = null;

?>
<?php include('./header.php'); ?>
<h1>管理者ログイン</h1>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
  <ul>
    <li>
      <label>ID</label>
      <input type="text" name="id" size="60" />
    </li>
    <li>
      <label>password</label>
      <input type="password" name="pass" rows="10" cols="60" />
    </li>
  </ul>
  <input type="submit" value="ログイン" class="sbt"/>
</form>
<?php include('./footer.php'); ?>
