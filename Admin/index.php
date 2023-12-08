<?php
require __DIR__ . "/includes/bootstrap.php";

// Parse the URL and print the resulting array
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
// print_r($uri);

require PROJECT_ROOT_PATH . "./controller/AdminController.php";

if ($uri[3]=='') {
    header("location:home.html");
}

// Add this code at the end of your index.php file
if (isset($_GET['action'])) {
    $obj = new AdminController();
    $obj->{$_GET['action']}();
}

?>