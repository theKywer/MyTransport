-- =======================================================
-- База данных для Yii 2
-- =======================================================
CREATE DATABASE IF NOT EXISTS `yii`
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;

-- =======================================================
-- База данных для Laravel
-- =======================================================
CREATE DATABASE IF NOT EXISTS `laravel`
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;

-- =======================================================
-- Пользователь
-- =======================================================
CREATE USER IF NOT EXISTS 'kywer'@'%' IDENTIFIED BY '123123';

-- Права на Yii
GRANT ALL PRIVILEGES ON yii.* TO 'kywer'@'%';

-- Права на Laravel
GRANT ALL PRIVILEGES ON laravel.* TO 'kywer'@'%';

-- Применяем
FLUSH PRIVILEGES;