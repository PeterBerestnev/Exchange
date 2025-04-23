# FlowBack

Проект разработан по нестандартной для Laravel структуре т.к. стандартная структура не предоставляет достаточной гибкости и пространства для масштабирования.

Проект придерживается гексогональной архитектуры и способен содержать N модулей со слоистой архитектурой.

## Установка зависимостей

Перед началом работы убедитесь, что у вас установлены:

- [PHP](https://www.php.net/) (версия ^8.2)
- [Composer](https://getcomposer.org/) (Версия ^2.6)
- [Node.js](https://nodejs.org/) (версия ^16.20)
- [npm](https://www.npmjs.com/) (версия ^8.19)
- [Git](https://git-scm.com/)

### 1. Клонирование репозитория

Репозиторий: https://github.com/PeterBerestnev/FlowBack

```bash
git clone https://github.com/PeterBerestnev/FlowBack.git
cd FlowBack
```

### 2. Установка PHP зависимостей
```bash
composer install
```

### 3. Установка JavaScript зависимостей
```bash
npm install
```

### 4. Настройка окружения
```bash
cp .env.example .env
```

Отредактируйте .env файл, указав:

Ключ API для openexchange задав значение параметру OPEN_EXCHANGE_APP_ID

### 5. Генерация ключа приложения
```bash
php artisan key:generate
```
### 5. Генерация ключа приложения
```bash
php artisan key:generate
```
### 6. Запуск сервера разработки
```bash
php artisan serve
```