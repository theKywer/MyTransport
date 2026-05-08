-- =======================================================
-- База данных для Laravel
-- =======================================================
CREATE DATABASE IF NOT EXISTS `laravel`
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;

-- Корневой пользователь создаёт служебного админа, если ещё не создан
CREATE USER IF NOT EXISTS 'admin_db'@'%' IDENTIFIED BY 'wasd123';

-- Создаём пользователя kywer для Laravel
CREATE USER IF NOT EXISTS 'kywer'@'%' IDENTIFIED BY '123123';

-- Права на Laravel
GRANT ALL PRIVILEGES ON laravel.* TO 'admin_db'@'%';
GRANT ALL PRIVILEGES ON laravel.* TO 'kywer'@'%';

-- Применяем
FLUSH PRIVILEGES;