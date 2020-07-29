<?php
mb_internal_encoding("utf8");

session_start();

try{
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","root");
}catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインをして下さい。</p>
    <a href='http://localhost/login_mypage/login.php'>ログイン画面へ<a>"
       );
}

$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","root");

$stmt = $pdo->prepare("update login_mypage set name = ?, mail = ?, password = ?,picture = ?, comments = ? where id = ?");

$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['picture']);
$stmt->bindValue(5,$_POST['comments']);
$stmt->bindValue(6,$_SESSION['id']);

$stmt->execute();

$pdo = null;

$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","root");
$stmt = $pdo->prepare("select * from login_mypage where id = ?");

$stmt->bindValue(1,$_SESSION['id']);

$stmt->execute();

$pdo = null;

foreach ($stmt as $row) {
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['comments'] = $row['comments'];
}


header('location:http://localhost/login_mypage/mypage.php');

?>


