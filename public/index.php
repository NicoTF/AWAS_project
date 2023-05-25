<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/../tools/error_config.php";
global $DB;
require_once '../tools/db_conn.php';
require_once '../tools/utils.php';
require_once '../tools/check_auth.php';
?>

<html>
<body>
<?php include '../tools/menu.php'; ?>
<h1> Welcome <?php echo $_SESSION['username'] ?>! </h1>
<div id="posts">
    <?php
    $posts = $DB->query("SELECT posts.*, username FROM posts inner join users u on u.id = posts.user_id order by posts.id desc");
    foreach ($posts as $post) {
        buildPost($post);
    }
    ?>
</div>
</body>
</html>
