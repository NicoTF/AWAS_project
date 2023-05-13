<?php
require_once '../../tools/db_conn.php';
global $DB;

$postId = $_GET['id'];
$q = $DB->prepare("SELECT * FROM posts WHERE id = ?");
$q->execute([$postId]);
$post = $q->fetch();

if ($post) {
    echo file_get_contents("../images/" . $post['image_path']);
}