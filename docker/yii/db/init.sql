-- =======================================================
-- База данных для Yii 2
-- =======================================================
CREATE DATABASE IF NOT EXISTS `yii`
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;

-- Права на Laravel
GRANT ALL PRIVILEGES ON yii.* TO 'admin_db'@'%';

-- Применяем
FLUSH PRIVILEGES;