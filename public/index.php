<?php
global $DB;
require_once '../tools/db_conn.php';
?>
    <header>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"
                integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="js/add_img.js"></script>
        <link rel="stylesheet" href="css/styles.css">
    </header>
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