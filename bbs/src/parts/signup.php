<!DOCTYPE html>
    <?php 

        $webroot = $_SERVER['DOCUMENT_ROOT'];
        $title = "真夜中すぎるFPS"; 

    ?>
<html>
    <?php
    
        include_once($webroot."/src/common/setup.php"); 
        include_once($webroot."/src/parts/head.php"); 
        include_once($webroot."/src/parts/body.php"); 

    ?>
<h1 >新規登録の方はこちら</h1>
<form action="signUp.php" method="post">
        <label for="email">Eﾒｰﾙ</label>
        <input type="email" name="email"><br>
        <label for="password">パスワード</label>
        <input type="password" name="password">
        <button type="submit">サインアップ</button>
        <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
      </div>
      
      
      <p><a href="login.php">登録をすでにされた方はこちら</a></p>
      
    </form>
  </html>