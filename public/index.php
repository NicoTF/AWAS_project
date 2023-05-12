<?php
global $DB;
require_once '../tools/db_conn.php';
include 'login.php';
?>
<body>
<?php include '../tools/menu.php'; ?>
    <h1> Welcome! </h1>
    <label>
        <input type="text" name="url" placeholder="Enter image url"/>
    </label>
    <input type="submit" value="Add image" id="add_img"/>
<?php
$images = $DB->query("SELECT * FROM photos order by id desc");
foreach ($images as $image) {
    ?>
    <div class="image">
        <img src='<?php echo $image['url'] ?>' alt="image"/>
    </div>
    <?php
}
?>
</body>
