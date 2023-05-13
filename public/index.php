<?php
global $DB;
require_once '../tools/db_conn.php';
require_once 'check_auth.php';
?>
<body>
<?php include '../tools/menu.php'; ?>
    <h1> Welcome <?php echo $_SESSION['username'] ?>! </h1>
<?php
$posts = $DB->query("SELECT posts.*, username FROM posts inner join users u on u.id = posts.user_id order by posts.id desc");
foreach ($posts as $post) {
    ?>
    <div class="post">
        <h3>@<?php echo $post['username']; ?></h3>
        <img src="/images/<?php echo $post['image_path']; ?>"/>
        <p><?php echo $post['description']; ?></p>
    </div>
    <?php
}
?>
</body>
