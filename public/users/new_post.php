<?php
require_once '../../tools/check_auth.php';
require_once '../../tools/db_conn.php';
global $DB;

if (isset($_POST['submit'])) {
    if (!isset($_FILES['image']) || UPLOAD_ERR_OK !== $_FILES['image']['error']) {
        die('Upload failed with error code ' . $_FILES['image']['error']);
    }
    $file = $_FILES['image'];
    $fileName = $file['name'];

    // Check if mime type is image
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    if (!str_contains($mime, 'image')) {
        die('Invalid file type');
    }

    $newPath = dirname(__DIR__) . '/../images/' . $fileName;

    if (move_uploaded_file($file['tmp_name'], $newPath)) {
        $description = $_POST['description'];
        $uid = $_SESSION["id"];

        $query = $DB->prepare('INSERT INTO posts (image_path, description, user_id) VALUES (?, ?, ?)');
        if ($query->execute([$fileName, $description, $uid])) {
            echo 'Picture posted! <a href="/index.php">Home</a>';
            exit();

        } else {
            echo 'Error creating post';
            exit();
        }
    } else {
        echo 'Error uploading file';
        exit();
    }
}

?>
<?php /*
<body>
<?php include '../../tools/menu.php'; ?>
<h1>Upload your photo</h1>
<!-- Upload image form -->
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image"/>
    <label>
        <input type="text" name="description" placeholder="Enter description"/>
    </label>
    <input type="submit" name="submit" value="Upload"/>
</form>
</body>
*/ ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Upload your photo</title>
</head>
<body>
<?php include '../../tools/menu.php'; ?>
<!-- Upload image form -->
<div id="newpost">
    <h1>Upload your photo</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>
            Upload Image:
            <input type="file" name="image" accept="image/*" required/>
        </label>
        <label>
            Description:
            <input type="text" name="description" placeholder="Enter description" required/>
        </label>
        <input type="submit" name="submit" value="Upload"/>
    </form>
</div>
</body>
</html>
