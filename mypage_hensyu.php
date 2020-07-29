<?php
mb_internal_encoding("utf8");

session_start();

mb_internal_encoding("utf8");
$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","root");
$stmt =$pdo->prepare("select * from login_mypage where id = ?"); 

    
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

if(empty($_POST['form_mypage'])){
    header("location:login_error.php");
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
                <p>こんにちは！　<?php echo $_SESSION['name']; ?>さん</p>
                <img class="profile" src="<?php echo $_SESSION['picture']; ?>">
                <form action="mypage_update.php" method="post">
                <div class="naiyou">
                    <p>氏名 ： <input type="text" size="40" name="name" value="<?php echo $_SESSION['name']; ?>" required></p>
                    <p>メール : <input type="text" size="40" name="mail" value="<?php echo $_SESSION['mail']; ?>" 
                                    patten="^[a-z0-9._%+-]+@[a-z0-9.-]+¥.[a-z]{2,3}$" required></p>
                    <p>パスワード : <input type="text" size="40" name="password" value="<?php echo $_SESSION['password']; ?>"
                                      patten="^[a-z0-9._%+-]+@[a-z0-9.-]+¥.[a-z]{2,3}$" required></p>
                </div>
                <div class="comments">
                    <textarea rows="3" cols="100" name="comments"><?php echo $_SESSION['comments']; ?></textarea>
                </div>       
                <div class="hensyu">
                    <input type="submit" class="button1" name="hensyu" value="この内容に変更する">
                </div>
                     <input type="hidden" value="<?php echo $_SESSION['picture']; ?>" name="picture">
                   </form>
            </div>
               
        </main>
        
        <footer>
        ©︎ 2018 Inter Nous.inc. All right reserved
        </footer>
        
        </body>
</html>

                