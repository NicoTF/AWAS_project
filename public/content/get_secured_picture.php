<?php
require_once '../../tools/db_conn.php';
global $DB;

$filename = $_GET['name'];

if ($filename) {
    $filename = base64_decode($filename);
    $path = "../../images/$filename";
    if (!file_exists($path)) {
        die("File not found: $path");
    }
    header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
    header("Content-Type: application/octet-stream");
    header("Cache-Control: public");
    header("Content-Transfer-Encoding: Binary");
    header("Content-Length:" . filesize($path));
    header("Content-Disposition: attachment; filename=$filename");
    readfile($path);
}