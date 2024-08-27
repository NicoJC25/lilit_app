<?php

// Order: hostname, username, password, database
$db = mysqli_connect('localhost', 'root', '1234567890', 'lilit_bd');

if (!$db) {
    echo "Hubo un error";
    exit;
}
