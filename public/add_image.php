<?php
require_once '../tools/db_conn.php';
global $DB;

$url = $_GET['url'];

// check if url is valid
if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
    echo "Invalid URL";
    exit;
}

$query = $DB->prepare("INSERT INTO photos (url, user_id) VALUES (?, ?)");
if ($query->execute([$url, 1]) === FALSE) {
    echo "Error inserting image";
    exit;
}