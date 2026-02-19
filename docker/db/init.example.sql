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
CREATE USER IF NOT EXISTS 'your_user'@'%' IDENTIFIED BY 'your_password';

-- Права на Yii
GRANT ALL PRIVILEGES ON yii.* TO 'your_user'@'%';

-- Права на Laravel
GRANT ALL PRIVILEGES ON laravel.* TO 'your_user'@'%';

-- Применяем
FLUSH PRIVILEGES;