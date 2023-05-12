<?php
require_once '../users/db_conn.php';
global $DB;

if(isset($_POST['foo'])) {}
?>
<h1>Upload your photo</h1>
<!-- Upload image form -->
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" />
    <input type="text" name="description" placeholder="Enter description" />
    <input type="submit" name="submit" value="Upload" />
</form>
