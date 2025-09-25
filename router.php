<?php
// Получаем запрошенный путь (например, /about)
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Если путь пустой — загружаем index.php
if ($path === '/' || $path === '') {
    require 'index.php';
    exit;
}

// Убираем первый слэш и формируем имя файла
$file = ltrim($path, '/');
if (file_exists($file)) {
    return false; // отдать статический файл (css, js, картинки)
}

// Если запрошен /about → ищем about.php
if (file_exists($file . '.php')) {
    require $file . '.php';
    exit;
}

// Если ничего не нашли — отдать 404
http_response_code(404);
echo "<h1>404 Not Found</h1>";