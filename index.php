<?php

// Шаблон статичных файлов.
$pattern = '/\.(?:png|jpg|jpeg|gif|html|eot|svg|ttf|woff|woff2|js|css|map)$/';

// так как предусмотренно выполнять задачи из под консоли, проверяеи тип обращения.
if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER['REQUEST_METHOD'])) {
    
    // Если просят статику, игнорируем запуск приложения.
    if (preg_match($pattern, $_SERVER["REQUEST_URI"])) return false;

    // Запускаем приложение
    include_once "./server/Main.php";
    Main::run();
} else {
    // Иначе коректируем запрос
    $_SERVER['REQUEST_URI'] = $argv[1] ?? "help";
    $_SERVER['REQUEST_METHOD'] = "CLI";

    // Запускаем приложение
    include_once "./server/Main.php";
    Main::run();
}