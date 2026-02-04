<?php
define('WEB_ROOT', '/phpNINH/BUOI1/NguyenDinhAnNinh');
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Kiểm tra phần đầu tiên của URL để xác định Controller
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'DefaultController';

// Kiểm tra phần thứ 2 để xác định Action (Hàm)
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

// Kiểm tra file Controller có tồn tại không
if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    die('Controller not found');
}

require_once 'app/controllers/' . $controllerName . '.php';

$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    die('Action not found');
}

// Gọi hàm thực thi
call_user_func_array([$controller, $action], array_slice($url, 2));
?>