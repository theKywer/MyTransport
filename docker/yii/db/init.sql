-- =======================================================
-- База данных для Yii 2
-- =======================================================
CREATE DATABASE IF NOT EXISTS `yii`
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;

-- Создаём служебного пользователя и задаём пароль
CREATE USER IF NOT EXISTS 'admin_db'@'%' IDENTIFIED BY 'wasd123';

-- Права на Yii
GRANT ALL PRIVILEGES ON yii.* TO 'admin_db'@'%';

-- Применяем
FLUSH PRIVILEGES;