# Exchanger
Проект реализует взаимодействие с API сервиса OpenExchangeRates для получения валютных курсов.

Проект построен по модульной структуре с четким разделением зон ответственности, что обеспечивает:

- Гибкость масштабирования

- Поддержку слоистой архитектуры внутри модулей

- Удобство тестирования компонентов
## Требования

Перед началом работы убедитесь, что у вас установлены:


- [Git](https://git-scm.com/)

- Docker

- Docker Compose


# Быстрый старт

### 1. Клонирование репозитория

```bash
git clone https://github.com/PeterBerestnev/Exchange.git
cd Exchange
```

### 2.  Настройка окружения
```bash
cp .env.example .env
```
Отредактируйте .env файл, указав:

Ключ API для openexchange задав значение параметру OPEN_EXCHANGE_APP_ID

Ключ можно получить при регистрации по ссылке https://openexchangerates.org/signup/free

### 3. Управление проектом 

Cборка контейнеров
```bash
docker compose build
```

Запуск контейнеров
```bash
docker compose up
```
Остановка контейнеров
```bash
docker compose stop
```
Удаление контейнеров
```bash
docker compose rm
```

# Тестирование API
После запуска документация доступна по адресу:
http://localhost:8080/api/documentation

