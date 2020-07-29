<?php
mb_internal_encoding("utf8");

$temp_pic_name = $_FILES['picture']['tmp_name'];

$original_pic_name =$_FILES['picture']['name'];
$path_filename = './image/'.$original_pic_name;

move_uploaded_file($temp_pic_name,'./image/'.$original_pic_name);

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="register_confirm.css">
    </head>
        <body>
             <header>
                <img src="4eachblog_logo.jpg">
                <div class="login"><a href="login.php">ログイン</a></div>
            </header>
            
            <main>
           <div class="mypage">
                <h2>会員登録　確認</h2>
                <p>こちらの内容で登録しても宜しいでしょうか？</p>
                
               <div class="touroku">
                <label>氏名 : </label><?php echo $_POST['name']; ?><br>
               <label>メール : </label><?php echo $_POST['mail']; ?><br>
                <label>パスワード : </label><?php echo $_POST['password']; ?><br>
                <label>プロフィール写真 : </label><?php echo $original_pic_name; ?><br>
                <label>コメント : </label><?php echo $_POST['comments']; ?>
                </div>
            
            
            <form action="register.php" type="submit" method="post">
                <input type="submit" class="submit-button1" value="戻って修正する">
            </form>
               
        <form action="register_insert.php" method="post" enctype="multipart/form-data">
            <input type="submit" class="submit-button2" value="登録する">
            <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
            <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
            <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
            <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
            <input type="hidden" value="<?php echo $path_filename; ?>" name="picture">
        </form>
        
        </div>
        </main>
            
        <footer>
            ©︎ 2018 Inter Nous.inc. All right reserved
        </footer>

        </body>
</html>