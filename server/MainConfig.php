<?php

/**
 * Конфигурация приложения.
 */
class MainConfig {

    // Тип базы данных.
    // ЗЫ: Не забываем сконфигурировать(/server/database/models/pdo/drivers/PDOConfig.php)!
    const DB_TYPE = "pdo";

    // Тема оформления пользовательского интерфейса
    const UITHEME = "bootstrap";
}