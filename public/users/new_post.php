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
    $newPath = dirname(__DIR__) . '/../images/' . $fileName;

    if (move_uploaded_file($file['tmp_name'], $newPath)) {
        $description = $_POST['description'];
        $uid = $_SESSION["id"];

        $query = $DB->prepare('INSERT INTO posts (image_path, description, user_id) VALUES (?, ?, ?)');
        if($query->execute([$fileName, $description, $uid])) {
            echo 'Picture posted!';
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
