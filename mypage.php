<?php
mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['id'])){

try{
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","root");
}catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインをして下さい。</p>
    <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
       );
}


    
$stmt =$pdo->prepare("select * from login_mypage where mail = ? && password = ? "); 

    
$stmt->bindValue(1,$_POST["mail"]);
$stmt->bindValue(2,$_POST["password"]);
    
$stmt->execute();
    
$pdo = null;

while($row=$stmt->fetch()){
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['comments'] = $row['comments'];
}
    
    
    if(empty($_SESSION['id'])){
        header("Location:login_error.php");
    }
    if(!empty($_POST['login_keep'])){
        $_SESSION['login_keep'] = $_POST['login_keep'];
    }
}

if(!empty($_SESSION['id'])&& !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
    
}else if(empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
}


?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="mypage.css">
    </head>

    <body>
         <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="log_out.php">ログアウト</a></div>
        </header>
        
        <main>
            <div class="mypage">
                <h2>会員情報</h2>
                <div class="hello">
                    <p>こんにちは！　<?php echo $_SESSION['name']; ?>さん</p>
                </div>    
                <img class="profile" src="<?php echo $_SESSION['picture']; ?>">
                <div class="naiyou">
                    <p>氏名 ： <?php echo $_SESSION['name']; ?></p>
                    <p>メール : <?php echo $_SESSION['mail']; ?></p>
                    <p>パスワード : <?php echo $_SESSION['password']; ?></p>
                </div>
                <div class="comments">
                    <?php echo $_SESSION['comments']; ?>
                </div>
                <form action="mypage_hensyu.php" method="post"class="form_center">
                    <input type="hidden" value="<?php echo rand(1,10); ?>" name="form_mypage">
                    <div class="hensyubutton">
                        <input type="submit" class="button1" name="hensyu" value="編集する" size="35">
                    </div>
                </form>
            </div>
        </main>
        
        <footer>
        ©︎ 2018 Inter Nous.inc. All right reserved
        </footer>
    
    </body>
</html>














































