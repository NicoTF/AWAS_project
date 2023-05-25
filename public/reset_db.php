<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/../tools/error_config.php";
require_once '../tools/db_conn.php';

try {
    init_db();
} catch (Exception $e) {
    echo $e->getMessage();
}

echo 'Database reset!';