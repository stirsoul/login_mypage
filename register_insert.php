<?php
    
mb_internal_encoding("utf8");

$pdo = new PDO("mysql:dbname=lesson01;host=localhost;", "root","root");
    
$stmt = $pdo->prepare("insert into login_mypage (name,mail,password,picture,comments)values(?,?,?,?,?)");

$stmt->bindvalue(1,$_POST['name']);
$stmt->bindvalue(2,$_POST['mail']);
$stmt->bindvalue(3,$_POST['password']);
$stmt->bindvalue(4,$_POST['picture']);
$stmt->bindvalue(5,$_POST['comments']);

$stmt->execute();
$pdo = NULL;

header('location:after_register.html'); ?>
  
