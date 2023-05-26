<link rel="stylesheet" href="/css/styles.css">
<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/../tools/error_config.php";
require_once '../../tools/check_auth.php';
require_once '../../tools/utils.php';
require_once '../../tools/db_conn.php';
global $DB;

if (isset($_POST['submit'])) {
    if (!isset($_FILES['image']) || UPLOAD_ERR_OK !== $_FILES['image']['error']) {
        HTMLError('Upload failed with error code ' . $_FILES['image']['error']);
    } else {
        $file = $_FILES['image'];
        $fileName = $file['name'];

        // Check if mime type is image
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        if (!str_contains($mime, 'image')) {
            HTMLError('Invalid file type');
        } else {

            // Pick a random name for the image, and check if it already exists
            do {
                $fileName = bin2hex(random_bytes(16)) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            } while (file_exists(dirname(__DIR__) . '/../images/' . $fileName));

            $newPath = dirname(__DIR__) . '/../images/' . $fileName;

            if (move_uploaded_file($file['tmp_name'], $newPath)) {
                $description = $_POST['description'];
                $uid = $_SESSION["id"];

                $query = $DB->prepare('INSERT INTO posts (image_path, description, user_id) VALUES (?, ?, ?)');
                if ($query->execute([$fileName, $description, $uid])) {
                    HTMLmessage('Picture posted! <a href="/index.php">Home</a>');
                } else {
                    HTMLError('Something went wrong. Please <a href="/users/new_post.php">retry</a>');
                    exit();
                }
            } else {
                HTMLError('Something went wrong. Please <a href="/users/new_post.php">retry</a>');
                exit();
            }
        }
    }
}

?>

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
