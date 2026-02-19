-- =======================================================
-- База данных для Symfony
-- =======================================================
CREATE DATABASE IF NOT EXISTS `symfony`
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;

-- Права на Laravel
GRANT ALL PRIVILEGES ON symfony.* TO 'admin_db'@'%';

-- Применяем
FLUSH PRIVILEGES;