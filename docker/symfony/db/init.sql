-- =======================================================
-- База данных для Symfony
-- =======================================================
CREATE DATABASE IF NOT EXISTS `symfony`
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;

-- Создаём пользователя для приложений и даём пароль
CREATE USER IF NOT EXISTS 'admin_db'@'%' IDENTIFIED BY 'wasd123';

-- Права на Symfony
GRANT ALL PRIVILEGES ON symfony.* TO 'admin_db'@'%';

-- Применяем
FLUSH PRIVILEGES;