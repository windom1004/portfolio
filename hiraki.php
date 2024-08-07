<?php
session_start();
$mode = 'input';
$errmessage = array();
if( isset($_POST['back']) && $_POST['back'] ){
// 何もしない
} else if( isset($_POST['confirm']) && $_POST['confirm'] ){
    // 確認画面
if( !$_POST['name'] ) {
    $errmessage[] = "名前を入力してください";
} else if( mb_strlen($_POST['name']) > 100 ){
    $errmessage[] = "名前は100文字以内にしてください";
}
    $_SESSION['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES);

    if( !$_POST['email'] ) {
        $errmessage[] = "Eメールを入力してください";
    } else if( mb_strlen($_POST['email']) > 200 ){
        $errmessage[] = "Eメールは200文字以内にしてください";
} else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
    $errmessage[] = "メールアドレスが不正です";
    }
    $_SESSION['email']    = htmlspecialchars($_POST['email'], ENT_QUOTES);

    if( !$_POST['message'] ){
        $errmessage[] = "お問い合わせ内容を入力してください";
    } else if( mb_strlen($_POST['message']) > 500 ){
        $errmessage[] = "お問い合わせ内容は500文字以内にしてください";
    }
    $_SESSION['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);

    if( $errmessage ){
    $mode = 'input';
} else {
    $mode = 'confirm';
}
} else if( isset($_POST['send']) && $_POST['send'] ){
// 送信ボタンを押したとき
$message  = "お問い合わせを受け付けました \r\n"
            . "名前: " . $_SESSION['name'] . "\r\n"
            . "email: " . $_SESSION['email'] . "\r\n"
            . "お問い合わせ内容:\r\n"
            . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['message']);
    mail($_SESSION['email'],'お問い合わせありがとうございます',$message);
mail('fuga@hogehoge.com','お問い合わせありがとうございます',$message);
$_SESSION = array();
$mode = 'send';
} else {
$_SESSION['name'] = "";
$_SESSION['email']    = "";
$_SESSION['message']  = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<details id="sample">
    <summary id="sample_s">サンプル1</summary>
    <p>CSSでの主な変更点</p>
    <ul>
      <li>枠をつける</li>
      <li>カーソルが乗った時ポインターにする</li>
      <li>アウトライン（クリックしたときに出る黒い枠）を消す</li>
      <li>開いたときにsummaryに下線をつける</li>
    </ul>
  </details>
  <details id="sample2">
    <summary id="sample2_s">サンプル2</summary>
    <?php if( $mode == 'input' ){ ?>
        <!-- 入力画面 -->
        <?php
            if( $errmessage ){
            echo '<div style="color:red;">';
            echo implode('<br>', $errmessage );
            echo '</div>';
            }
        ?>
        <form action="./hiraki.php" method="post">
            名前<br><input type="text"    name="name" value="<?php echo $_SESSION['name'] ?>"><br>
            Eメール<br><input type="email"   name="email"    value="<?php echo $_SESSION['email'] ?>"><br>
            お問い合わせ内容<br>
            <textarea cols="40" rows="8" name="message"><?php echo $_SESSION['message'] ?></textarea><br>
            <input class="hover" type="submit" name="confirm" value="確認" />
        </form>
        <?php } else if( $mode == 'confirm' ){ ?>
        <!-- 確認画面 -->
        <form action="./hiraki.php" method="post">
            名前:    <?php echo $_SESSION['name'] ?><br>
            Eメール: <?php echo $_SESSION['email'] ?><br>
            お問い合わせ内容<br>
            <?php echo nl2br($_SESSION['message']) ?><br>
            <input class="hover" type="submit" name="back" value="戻る" />
            <input class="hover" type="submit" name="send" value="送信" />
        </form>
        <?php } else { ?>
        <!-- 完了画面 -->
        送信しました。お問い合わせありがとうございました。<br>
        <?php } ?>
                    </form>
    <p>
      ◆キャラ名<br>
      <a href="#">小説タイトル</a><br>
      <a href="#">小説タイトル</a><br>
      <a href="#">小説タイトル</a><br>
      <a href="#">小説タイトル</a><br>
      </p>
  </details>
<style>
    summary {
    cursor: pointer;
    outline:none;
}
details[open] {
    margin-bottom: 10px;
    max-height:100%;
}
details[open] summary {
    border-bottom: 1px solid #ddd;
}
details {
    max-height:2em;
    overflow: hidden;
    border: 1px solid #aaa;
    border-radius: 8px;
    margin: 6px 0;
    padding: 5px 10px;
}
details div {
    height:auto;
    overflow-y:auto;
}
</style>
<script>
    function open(openSave, openID){
   if (sessionStorage.getItem(openSave) != null){
      if (sessionStorage.getItem(openSave) == 1){
         document.getElementById(openID).setAttribute("open","");
      }
   }
}
open('openSAMPLEsave', "sample");
open('openSAMPLE2save', "sample2");

function stSave(openSave) {
   var saveVar = sessionStorage.getItem(openSave);
   if (saveVar == null ||saveVar == 0){
      sessionStorage.setItem(openSave, '1');
   } else {
      sessionStorage.setItem(openSave, '0');
   }
}

document.getElementById("sample_s").onclick = function() {
    stSave('openSAMPLEsave');
}
document.getElementById("sample2_s").onclick = function() {
    stSave('openSAMPLE2save');
}
</script>
</body>
</html>