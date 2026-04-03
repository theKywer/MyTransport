# =============================================================================
# 🚀 MyTransport — Управление проектами на Laravel, Yii и Symfony
#
# Цель: единый интерфейс для инициализации, запуска и управления
#       несколькими PHP-проектами в Docker.
#
# Команды: make help — посмотреть все доступные команды
# =============================================================================

.ONESHELL:
SHELL := /bin/bash

# =============================================================================
# 📁 ПУТИ К ПРОЕКТАМ
# =============================================================================
APPS_DIR        := apps
LARAVEL_DIR     := $(APPS_DIR)/laravel
YII_DIR         := $(APPS_DIR)/yii
SYMFONY_DIR     := $(APPS_DIR)/symfony

# =============================================================================
# 📁 ПУТИ К ПРОЕКТАМ
# =============================================================================
LARAVEL_DIR     := $(APPS_DIR)/laravel
YII_DIR         := $(APPS_DIR)/yii
SYMFONY_SQL_INIT := docker/symfony/db/init.sql

# =============================================================================
# 🐳 DOCKER COMPOSE КОМАНДЫ
# =============================================================================

# подгружаем переменные из файла среды, чтобы Makefile их видел
-include docker/db/.env

DOCKER_COMPOSE_LARA   := docker compose -f docker/laravel/docker-compose.yaml
DOCKER_COMPOSE_YII    := docker compose -f docker/yii/docker-compose.yaml
DOCKER_COMPOSE_SYMFONY:= docker compose -f docker/symfony/docker-compose.yaml
DOCKER_COMPOSE_DB     := docker compose --env-file docker/db/.env -f docker/db/docker-compose.yaml

# =============================================================================
# 🔗 РЕПОЗИТОРИИ ПРОЕКТОВ
# =============================================================================
PROJECT_LARAVEL   := ssh://git@gitverse.ru:2222/kano2711/MyTransportLaravel.git
PROJECT_YII       := ssh://git@gitverse.ru:2222/kano2711/MyTransportYii.git
PROJECT_SYMFONY   := ssh://git@gitverse.ru:2222/kano2711/MyTransportSymfony.git

# =============================================================================
# 🎨 ЦВЕТА ДЛЯ ВЫВОДА В ТЕРМИНАЛЕ
# =============================================================================
GREEN   := \033[32m
YELLOW  := \033[33m
BLUE    := \033[34m
RESET   := \033[0m

# =============================================================================
# 📜 ЦЕЛИ ПО УМОЛЧАНИЮ И СПРАВКА
# =============================================================================
.PHONY: help

help:
	@echo ""
	@echo -e "$(BLUE)🔥 MyTransport — Единая система управления PHP-проектами$(RESET)"
	@echo -e "$(BLUE)════════════════════════════════════════════════════════════$(RESET)"
	@echo ""
	@echo -e "$(GREEN)🔧 Инициализация проектов$(RESET)"
	@echo "  make init               — инициализировать все проекты"
	@echo "  make init-lara          — инициализировать Laravel"
	@echo "  make init-yii           — инициализировать Yii"
	@echo "  make init-symfony       — инициализировать Symfony"
	@echo ""
	@echo -e "$(GREEN)🚀 Запуск и остановка$(RESET)"
	@echo "  make up                 — запустить всё (БД, Laravel, Yii, Symfony)"
	@echo "  make up-db              — запустить только БД"
	@echo "  make up-lara            — запустить Laravel"
	@echo "  make up-yii             — запустить Yii"
	@echo "  make up-symfony         — запустить Symfony"
	@echo ""
	@echo "  make down               — остановить всё"
	@echo "  make down-db            — остановить БД"
	@echo "  make down-lara          — остановить Laravel"
	@echo "  make down-yii           — остановить Yii"
	@echo "  make down-symfony       — остановить Symfony"
	@echo ""
	@echo -e "$(GREEN)📊 Логи$(RESET)"
	@echo "  make logs               — логи всех сервисов"
	@echo "  make logs-db            — логи БД"
	@echo "  make logs-lara          — логи Laravel"
	@echo "  make logs-yii           — логи Yii"
	@echo "  make logs-symfony       — логи Symfony"
	@echo ""
	@echo -e "$(GREEN)📦 Управление зависимостями (Composer)$(RESET)"
	@echo "  make lara-composer-install    — установить зависимости Laravel"
	@echo "  make lara-composer-update     — обновить зависимости Laravel"
	@echo "  make lara-composer-require PACKAGE=package/name"
	@echo ""
	@echo "  make yii-composer-install     — установить зависимости Yii"
	@echo "  make yii-composer-update      — обновить зависимости Yii"
	@echo "  make yii-composer-require PACKAGE=package/name"
	@echo ""
	@echo "  make symfony-composer-install — установить зависимости Symfony"
	@echo "  make symfony-composer-update  — обновить зависимости Symfony"
	@echo "  make symfony-composer-require PACKAGE=package/name"
	@echo ""
	@echo -e "$(GREEN)⚙️ Проект-специфичные команды$(RESET)"
	@echo "  make lara-key-generate        — сгенерировать APP_KEY (Laravel)"
	@echo "  make lara-migrate             — применить миграции Laravel"
	@echo ""
	@echo "  make yii-migrate              — применить миграции Yii"
	@echo ""
	@echo "  make symfony-migrate          — применить миграции Symfony"
	@echo ""
	@echo -e "$(GREEN)🔧 Решение проблем$(RESET)"
	@echo "  make lara-fix-permissions     — исправить права Laravel"
	@echo "  make yii-fix-permissions      — исправить права Yii"
	@echo "  make symfony-fix-permissions  — исправить права Symfony"
	@echo ""
	@echo -e "$(YELLOW)💡 Пример:$(RESET)"
	@echo "  make init-symfony"
	@echo "  make lara-composer-require PACKAGE=laravel/breeze"
	@echo ""

# =============================================================================
# 🌐 СЕТЬ (если нужно создавать вручную)
# =============================================================================
.PHONY: up-network
up-network:
	@echo -e "$(BLUE)🌐 Создаём сеть MyTransportNetwork...$(RESET)"
	docker network create MyTransportNetwork 2>/dev/null || \
		echo -e "$(YELLOW)⚠️ Сеть MyTransportNetwork уже существует$(RESET)"

# =============================================================================
# 🔽 ИНИЦИАЛИЗАЦИЯ ПРОЕКТОВ
# =============================================================================
.PHONY: init init-lara init-yii init-symfony
init: up-db init-lara init-yii init-symfony
	@echo -e "$(GREEN)✅ Все проекты инициализированы!$(RESET)"

init-lara: lara-fix-permissions lara-run-sql up-lara lara-composer-install lara-key-generate lara-migrate

init-yii: up-db
	@if [ ! -d "$(YII_DIR)" ]; then \
		echo -e "$(GREEN)📁 Клонирую Yii...$(RESET)"; \
		mkdir -p $(APPS_DIR) && \
		git clone $(PROJECT_YII) $(YII_DIR); \
	else \
		echo -e "$(YELLOW)📁 Папка $(YII_DIR) уже существует — пропускаем$(RESET)"; \
	fi

init-symfony: symfony-clone symfony-fix-permissions symfony-run-sql up-symfony symfony-composer-install symfony-migrate
	@echo -e "$(GREEN)✅ Symfony полностью инициализирован!$(RESET)"

# =============================================================================
# 🐘 УПРАВЛЕНИЕ БАЗОЙ ДАННЫХ
# =============================================================================
.PHONY: run-sql

run-sql:
	@if [ -z "$(SQL_SCRIPT)" ]; then \
		echo -e "$(YELLOW)⚠️  Не указан SQL_SCRIPT"; \
		exit 1; \
	fi
	@echo -e "$(BLUE)🔥 Выполняем SQL-скрипт: $(SQL_SCRIPT)$(RESET)"
	# используем пользователя admin_db, он теперь создаётся в init.sql
	# используем root, пароль берём из файла docker/db/.env (подгружается ранее)
	docker exec -i MyTransportDB env MYSQL_PWD=${MYSQL_ROOT_PASSWORD} mysql -uroot -hlocalhost < "$(SQL_SCRIPT)" || \
		(echo -e "$(YELLOW)❌ Ошибка выполнения SQL$(RESET)" && exit 1)

# =============================================================================
# ▶️ ЗАПУСК СЕРВИСОВ
# =============================================================================
.PHONY: up up-db up-lara up-yii up-symfony
up: up-db up-lara up-yii up-symfony
	@echo -e "$(GREEN)✅ Все сервисы запущены!$(RESET)"

up-db:
	@echo -e "$(BLUE)🚀 Запуск БД...$(RESET)"
	$(DOCKER_COMPOSE_DB) up -d

up-lara:
	@echo -e "$(BLUE)🚀 Запуск Laravel...$(RESET)"
	$(DOCKER_COMPOSE_LARA) up -d

up-yii:
	@echo -e "$(BLUE)🚀 Запуск Yii...$(RESET)"
	$(DOCKER_COMPOSE_YII) up -d

up-symfony:
	@echo -e "$(BLUE)🚀 Запуск Symfony...$(RESET)"
	$(DOCKER_COMPOSE_SYMFONY) up -d

# =============================================================================
# ⏹️ ОСТАНОВКА СЕРВИСОВ
# =============================================================================
.PHONY: down down-db down-lara down-yii down-symfony
down: down-lara down-yii down-symfony down-db
	@echo -e "$(YELLOW)✅ Все сервисы остановлены.$(RESET)"

down-db:
	@echo -e "$(YELLOW)⏹️ Остановка БД...$(RESET)"
	$(DOCKER_COMPOSE_DB) down

down-lara:
	@echo -e "$(YELLOW)⏹️ Остановка Laravel...$(RESET)"
	$(DOCKER_COMPOSE_LARA) down

down-yii:
	@echo -e "$(YELLOW)⏹️ Остановка Yii...$(RESET)"
	$(DOCKER_COMPOSE_YII) down

down-symfony:
	@echo -e "$(YELLOW)⏹️ Остановка Symfony...$(RESET)"
	$(DOCKER_COMPOSE_SYMFONY) down

restart-lara: down-lara up-lara

# =============================================================================
# 📋 ЛОГИ
# =============================================================================
.PHONY: logs logs-db logs-lara logs-yii logs-symfony
logs: logs-db logs-lara logs-yii logs-symfony

logs-db:
	@echo -e "$(BLUE)📋 Логи БД...$(RESET)"
	$(DOCKER_COMPOSE_DB) logs -f

logs-lara:
	@echo -e "$(BLUE)📋 Логи Laravel...$(RESET)"
	$(DOCKER_COMPOSE_LARA) logs -f

logs-yii:
	@echo -e "$(BLUE)📋 Логи Yii...$(RESET)"
	$(DOCKER_COMPOSE_YII) logs -f

logs-symfony:
	@echo -e "$(BLUE)📋 Логи Symfony...$(RESET)"
	$(DOCKER_COMPOSE_SYMFONY) logs -f

# =============================================================================
# 🧰 LARAVEL: УПРАВЛЕНИЕ
# =============================================================================

lara-key-generate:
	@echo -e "$(BLUE)🔑 Генерация APP_KEY для Laravel...$(RESET)"
	$(DOCKER_COMPOSE_LARA) exec laravel-php php /var/www/html/artisan key:generate --ansi
	@echo -e "$(GREEN)✅ Ключ сгенерирован$(RESET)"

lara-clone:
	@echo -e "$(BLUE)🗄️ Загружаем проект из репозитория 'laravel'...$(RESET)"
	git clone $(PROJECT_LARAVEL) $(LARAVEL_DIR)

lara-run-sql:
	$(MAKE) run-sql SQL_SCRIPT=docker/laravel/db/init.sql

lara-migrate:
	@echo -e "$(BLUE)🔄 Применение миграций Laravel...$(RESET)"
	$(DOCKER_COMPOSE_LARA) exec laravel-php php artisan migrate --force
	@echo -e "$(GREEN)✅ Миграции применены$(RESET)"

lara-migrate-down:
	@echo -e "$(BLUE)🔄 Применение миграций Laravel...$(RESET)"
	$(DOCKER_COMPOSE_LARA) exec laravel-php php artisan migrate:rollback
	@echo -e "$(GREEN)✅ Миграции применены$(RESET)"

lara-composer-install:
	@echo -e "$(BLUE)📦 Установка зависимостей Laravel...$(RESET)"
	$(DOCKER_COMPOSE_LARA) exec laravel-php composer install
	@echo -e "$(GREEN)✅ Зависимости установлены$(RESET)"

lara-composer-update:
	@echo -e "$(BLUE)🔄 Обновление зависимостей Laravel...$(RESET)"
	$(DOCKER_COMPOSE_LARA) exec laravel-php composer update
	@echo -e "$(GREEN)✅ Зависимости обновлены$(RESET)"

lara-composer-require:
	@echo -e "$(BLUE)➕ Установка пакета Laravel: ${PACKAGE}$(RESET)"
	$(DOCKER_COMPOSE_LARA) exec laravel-php composer require ${PACKAGE}
	@echo -e "$(GREEN)✅ Пакет установлен$(RESET)"

lara-fix-permissions:
	@echo -e "$(BLUE)🔧 Исправление прав Laravel...$(RESET)"
	sudo chown -R $$(id -u):www-data $(LARAVEL_DIR)/storage $(LARAVEL_DIR)/bootstrap/cache
	sudo chmod -R 775 $(LARAVEL_DIR)/storage $(LARAVEL_DIR)/bootstrap/cache
	@echo -e "$(GREEN)✅ Права исправлены$(RESET)"

lara-terminal:
	@echo -e "$(BLUE)🖥️ Открываю консоль Laravel...$(RESET)"
	$(DOCKER_COMPOSE_LARA) exec laravel-php bash

# =============================================================================
# 🧰 YII: УПРАВЛЕНИЕ
# =============================================================================

yii-run-sql:
	$(MAKE) run-sql SQL_SCRIPT=docker/yii/db/init.sql

yii-migrate:
	@echo -e "$(BLUE)🔄 Применение миграций Yii...$(RESET)"
	$(DOCKER_COMPOSE_YII) exec YiiPHP php /var/www/html/yii migrate --interactive=0
	@echo -e "$(GREEN)✅ Миграции применены$(RESET)"

yii-composer-install:
	@echo -e "$(BLUE)📦 Установка зависимостей Yii...$(RESET)"
	$(DOCKER_COMPOSE_YII) run --rm composer install
	@echo -e "$(GREEN)✅ Зависимости установлены$(RESET)"

yii-composer-update:
	@echo -e "$(BLUE)🔄 Обновление зависимостей Yii...$(RESET)"
	$(DOCKER_COMPOSE_YII) run --rm composer update
	@echo -e "$(GREEN)✅ Зависимости обновлены$(RESET)"

yii-composer-require:
	@echo -e "$(BLUE)➕ Установка пакета Yii: ${PACKAGE}$(RESET)"
	$(DOCKER_COMPOSE_YII) run --rm composer require ${PACKAGE}
	@echo -e "$(GREEN)✅ Пакет установлен$(RESET)"

yii-fix-permissions:
	@echo -e "$(BLUE)🔧 Исправление прав Yii...$(RESET)"
	sudo chown -R $$(id -u):www-data $(YII_DIR)/runtime $(YII_DIR)/web/assets
	sudo chmod -R 775 $(YII_DIR)/runtime $(YII_DIR)/web/assets
	@echo -e "$(GREEN)✅ Права исправлены$(RESET)"

# =============================================================================
# 🧰 SYMFONY: УПРАВЛЕНИЕ
# =============================================================================
.PHONY: symfony-run-sql \ 
		symfony-fix-permissions \
		symfony-composer-install \
		symfony-composer-update \
		symfony-composer-require \
		symfony-env-copy \
		symfony-migrate

symfony-clone:
	@echo -e "$(BLUE)🗄️ Загружаем проект из репозитория 'symfony'...$(RESET)"
	git clone $(PROJECT_SYMFONY) $(SYMFONY_DIR)

symfony-run-sql:
	$(MAKE) run-sql SQL_SCRIPT=docker/symfony/db/init.sql

symfony-fix-permissions:
	@echo -e "$(BLUE)🔧 Настраиваем права для Symfony...$(RESET)"
	mkdir -p $(SYMFONY_DIR)/var/cache $(SYMFONY_DIR)/var/log $(SYMFONY_DIR)/var/sessions
	chmod -R 777 $(SYMFONY_DIR)/var 2>/dev/null || true
	@echo -e "$(GREEN)✅ Права на /var выставлены$(RESET)"

symfony-composer-install:
	@echo -e "$(BLUE)📦 Установка зависимостей Symfony...$(RESET)"
	$(DOCKER_COMPOSE_SYMFONY) exec symfony-php composer install
	@echo -e "$(GREEN)✅ Зависимости установлены$(RESET)"

symfony-composer-update:
	@echo -e "$(BLUE)🔄 Обновление зависимостей Symfony...$(RESET)"
	$(DOCKER_COMPOSE_SYMFONY) exec symfony-php composer update
	@echo -e "$(GREEN)✅ Зависимости обновлены$(RESET)"

symfony-composer-require:
	@echo -e "$(BLUE)➕ Установка пакета Symfony: ${PACKAGE}$(RESET)"
	$(DOCKER_COMPOSE_SYMFONY) exec symfony-php composer require ${PACKAGE}
	@echo -e "$(GREEN)✅ Пакет установлен$(RESET)"

symfony-env-copy:
	@if [ ! -f "$(SYMFONY_DIR)/.env" ]; then \
		echo -e "$(BLUE)📄 Создаём .env для Symfony...$(RESET)"; \
		cp $(SYMFONY_DIR)/.env.dist $(SYMFONY_DIR)/.env 2>/dev/null || \
		cp $(SYMFONY_DIR)/.env.example $(SYMFONY_DIR)/.env 2>/dev/null || \
		echo "APP_ENV=dev" > $(SYMFONY_DIR)/.env; \
	fi

symfony-migrate:
	@echo -e "$(BLUE)🔄 Применение миграций Symfony...$(RESET)"
	$(DOCKER_COMPOSE_SYMFONY) exec symfony-php php bin/console doctrine:migrations:migrate --no-interaction
	@echo -e "$(GREEN)✅ Миграции применены$(RESET)"
