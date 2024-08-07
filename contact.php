<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}
    $num=10;

    $dsn='mysql:host=localhost;dbname=id22207318_wwbo;charset=utf8';
    $user='id22207318_wwbo';
    $password='Kang-Kang-2024!';

    $page=1;
    if (isset($_GET['page'])&&$_GET['page']>1) {
        $page=intval($_GET['page']);
    }
    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt=$db->prepare("SELECT * FROM contact ORDER BY date DESC LIMIT :page, :num");

        $page=($page-1)*$num;
        $stmt->bindParam(':page',$page,PDO::PARAM_INT);
        $stmt->bindParam(':num',$num,PDO::PARAM_INT);

        $stmt->execute();
    } catch (PDOException $e) {
        exit("エラー:".$e->getMessage());
    }
?>
<!doctype html>
<html lang="ja" >
    <head>
        <title>contact</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@3.0.2/destyle.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    </head>
    <body>
    <header>
        <div class="hamburger">
            <div class="logo"><h1><a href="index.html"><img src="./img/logo_sheep.png" alt="logo">K's portfolio</a></h1></div>
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
                    <li><a href="/logout.php">logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
        <div>
            <!-- start main -->
            <h1>contact</h1>
<?php while ($row=$stmt->fetch()): ?>  <!--fetch 一軒ずつカラム名で取り出す　取り出すものがなくなったらfalseを返す  -->
    <div>
        <p><?php echo $row['name']; ?></p>
        <p><?php echo $row['email']; ?></p>
        <p><?php echo $row['date']; ?></p>
        <p><?php echo nl2br(htmlspecialchars($row['message'],ENT_QUOTES,'UTF-8')) ?></p>
    </div>
    <hr>
    <?php endwhile; ?>
    <?php
    try {
        $stmt=$db->prepare("SELECT COUNT(id)FROM contact");
        $stmt->execute();
    } catch (PDOException $e) {
        exit("エラー:".$e->getMessage());
    }
    $comments=$stmt->fetchColumn();
    $max_page=ceil($comments / $num);
    if ($max_page>=1) {
        echo '<nav><ul class="pagination">';
        for ($i=1; $i <=$max_page ; $i++) {
            echo '<li class="page-item"><a href="contact.php?page='.$i.'">'.$i.'-</a></li>';
        }
        echo '</ul></nav>';
    }
    ?>
            <!-- end main -->
        </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery.easing@1.4.1/jquery.easing.min.js"></script>
        <script src="./js/main.js"></script>
    </body>
</html>
