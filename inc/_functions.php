<?php
/**
 * Created by PhpStorm.
 * User: Shkodenko
 * Date: 23.03.2017
 * Time: 19:12
 */

function getTopMenu($uri) {
    $menuHtml = '';
    $menuItems = [
        ['uri' => '?page=home', 'linkText' => 'Home'],
        ['uri' => '?page=about', 'linkText' => 'About'],
        ['uri' => '?page=projects', 'linkText' => 'Projects'],
        ['uri' => '?page=comments', 'linkText' => 'Comments']
    ];
    $currentPage = 'home';
    if (isset($_REQUEST['page'])) {
        $currentPage = $_REQUEST['page'];
    }
    /* echo ' $currentPage: ' . $currentPage . '<br>'; */
    if (!empty($menuItems)) {
        $menuHtml .= '<ul class="nav navbar-nav">';
        foreach ($menuItems as $mi) {
            $class = '';
            if ($mi['uri'] == '?page=' . $currentPage) {
                $class = ' class="active"';
            }
            $menuHtml .= '<li' . $class . '><a href="' . $mi['uri'] . '">' . $mi['linkText'] . '</a></li>';
        }
        $menuHtml .= '</ul>';
    }
    return $menuHtml;
}

function getCurrentPageContent() {
    $pageContent = '';
    $allowInc = ['home', 'about', 'projects', 'comments'];
    if (!isset($_REQUEST['page'])) {
        $currentPage = 'home';
    } else {
        $currentPage = $_REQUEST['page'];
    }
    // echo '$currentPage: ' . $currentPage . '<br>';
    if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $currentPage . '.php') && in_array($currentPage, $allowInc)) {
        $fileName = dirname(__FILE__) . DIRECTORY_SEPARATOR . $currentPage . '.php';
    } else {
        $fileName = dirname(__FILE__) . DIRECTORY_SEPARATOR . '404.php';
    }

    ob_start();
    require_once $fileName;
    $pageContent = ob_get_clean();

    return $pageContent;
}

function getSiteFooter() {
    $fileName = dirname(__FILE__) . DIRECTORY_SEPARATOR . '_footer.php';

    ob_start();
    require_once $fileName;
    $footerHtml = ob_get_clean();

    return $footerHtml;
}


function getSiteHeader() {
    $fileName = dirname(__FILE__) . DIRECTORY_SEPARATOR . '_header.php';

    ob_start();
    require_once $fileName;
    $headerHtml = ob_get_clean();

    return $headerHtml;
}