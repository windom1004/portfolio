<?php
    session_start();
    if (isset($_POST['name'])&&isset($_POST['password'])) {
        $dsn='mysql:host=localhost;dbname=id22207318_wwbo;charset=utf8';
        $user='id22207318_wwbo';
        $password='Kang-Kang-2024!';
        try {
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "SELECT * FROM users WHERE name = :name AND users.password=:password" ;
            //create prepared statement
            $stmt=$db->prepare($sql);
            $stmt->bindParam(':name',$_POST['name'],PDO::PARAM_STR);
            $stmt->bindParam(':password',$_POST['password'],PDO::PARAM_STR);
            $stmt->execute();
            if ($row=$stmt->fetch()) {
                session_regenerate_id(true);
                $_SESSION['id']=$row['id'];
                $_SESSION['name']=$row['name'];
                header('Location:contact.php');
                exit();
            } else {
                header('Location:login.php');
                exit();
            }
        } catch (PDOException $e) {
            exit('エラー：'.$e->getMessage());
        }
    }
?>
<!doctype html>
<html lang="ja" >
    <head>
        <title>ksportfolio</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@3.0.2/destyle.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <header>
            <div class="hamburger">
                <div class="logo"><h1><a href="#top_body"><img src="./img/logo_sheep.png" alt="logo">K's portfolio</a></h1></div>
                <p class="btn-gNav">
                    <span></span>
                    <span></span>
                    <span></span>
                </p>
                <nav class="gNav">
                    <ul class="gNav-menu">
                        <li><a href="#about">about</a></li>
                        <li><a href="#work">work</a></li>
                        <li><a href="#contact">contact</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div>
            <!-- start main -->
            <form action="login.php" method="post" class="login">
                <h2>login</h2>
                <input type="text" id="name" name="name" class="form-control" placeholder="ID">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                <input type="submit" value="login">
            </form>
            <!-- end main -->
        </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery.easing@1.4.1/jquery.easing.min.js"></script>
        <script src="./js/main.js"></script>
    </body>
</html>
