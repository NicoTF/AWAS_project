<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/../tools/error_config.php";
require_once '../../tools/check_auth.php';
require_once '../../tools/db_conn.php';
require_once '../../tools/utils.php';
global $DB;

$uid = $_GET['uid'];

$query = $DB->prepare("SELECT username FROM users WHERE id = ?");
$query->execute([$uid]);
$username = $query->fetch()[0];



$query = $DB->prepare("SELECT * FROM posts WHERE user_id = ?");
$query->execute([$uid]);
$posts = $query->fetchAll();

?>
<body>
<?php
include '../../tools/menu.php';
echo "<h1>$username's posts</h1>";
?>
<div id="posts">
    <?php
    foreach ($posts as $post) {
        buildPost($post);
    }
    ?>
</div>
</body>

