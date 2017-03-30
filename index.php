<?php
/**
 * Created by PhpStorm.
 * User: Shkodenko
 * Date: 23.03.2017
 * Time: 19:02
 */

// phpinfo();
// exit;

require_once 'inc' . DIRECTORY_SEPARATOR . '_functions.php';

$title = 'Test title';
$siteName = 'My portfolio website';
$pageContent = 'Test page content';

ob_start();
include 'inc' . DIRECTORY_SEPARATOR . '_layout.php';
$websiteContent = ob_get_clean();
echo $websiteContent;
