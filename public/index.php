<?php
global $DB;
require_once '../tools/db_conn.php';
require_once 'check_auth.php';
?>

<html>


<?php include '../tools/menu.php'; ?>
    <h1> Welcome <?php echo $_SESSION['username'] ?>! </h1>
<?php
$posts = $DB->query("SELECT posts.*, username FROM posts inner join users u on u.id = posts.user_id order by posts.id desc");
foreach ($posts as $post) {
    ?>
    <div class="post">
        <h3>@<?php echo $post['username']; ?></h3>
        <img src="/content/get_secured_picture.php?name=<?php echo base64_encode($post['image_path']); ?>"/>
        <p><?php echo $post['description']; ?></p>
    </div>
    <?php
}
?>
</body>
</html>
