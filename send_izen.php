<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitize_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $message = sanitize_input($_POST['message']);

    // メールヘッダーインジェクション対策
    if (preg_match("/[\r\n]/", $name) || preg_match("/[\r\n]/", $email)) {
        die("不正な入力が検出されました。");
    }

    $to = "windom83@hotmail.com";
    $subject = "お問い合わせフォームからのメッセージ";
    $body = "名前: $name\nメールアドレス: $email\n\nメッセージ:\n$message";
    $headers = "From: $email";

    
    // デバッグ: メール送信前の確認
    echo "<pre>";
    echo "送信先: $to\n";
    echo "件名: $subject\n";
    echo "本文: $body\n";
    echo "ヘッダー: $headers\n";
    echo "</pre>";

    if (mail($to, $subject, $body, $headers)) {
        header("Location: thanks.php");
        exit();
    } else {
        // エラー情報の取得
        $error = error_get_last();
        echo "メッセージの送信に失敗しました。";
        echo "<pre>";
        print_r($error);
        echo "</pre>";
    }
} else {
    header("Location: index.html");
    exit();
}
?>