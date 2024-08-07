<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認ページ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@3.0.2/destyle.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>
<body class="confirm">
    <h2>確認ページ</h2>
    <form action="send.php" method="post" class="input_check">
        <p>名前: <?php echo $name; ?></p>
        <p>メールアドレス: <?php echo $email; ?></p>
        <p>メッセージ: <?php echo nl2br($message); ?></p>
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="message" value="<?php echo $message; ?>">
        <input type="submit" value="送信" class="btn  hover">
        <button type="button" class="btn  hover" onclick="history.back();">戻る</button>
    </form>
</body>
</html>
