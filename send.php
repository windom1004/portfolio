<?php

$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];

$dsn='mysql:host=localhost;dbname=id22207318_wwbo;charset=utf8';
$user='id22207318_wwbo';
$password='Kang-Kang-2024!';

try{
  $db=new PDO($dsn,$user,$password);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $stmt=$db->prepare(
    "INSERT INTO contact (id,name,email,message) VALUES (:id,:name,:email,:message)"
  );
  $stmt->bindParam(':id',$row['id'],PDO::PARAM_INT);
  $stmt->bindParam(':name',$name,PDO::PARAM_STR);
  $stmt->bindParam(':message',$message,PDO::PARAM_STR);
  $stmt->bindParam(':email',$email,PDO::PARAM_STR);
  $stmt->execute();
  header('Location:thanks.php');
  exit();
}catch(PDOException $e){
  exit('エラー：'.$e->getMessage());
}

?>