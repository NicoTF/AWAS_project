<?php
error_reporting(0);

// intercept errors and respond with a 500
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    echo "Something went wrong!";
    exit(500);
});