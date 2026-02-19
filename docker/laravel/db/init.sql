-- =======================================================
-- База данных для Laravel
-- =======================================================
CREATE DATABASE IF NOT EXISTS `laravel`
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;

-- Права на Laravel
GRANT ALL PRIVILEGES ON laravel.* TO 'admin_db'@'%';

-- Применяем
FLUSH PRIVILEGES;