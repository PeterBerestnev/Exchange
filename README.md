# Exchanger

Данный проект реализует взаимодействие с API стороннего сервиса предосттавляющего валютные курсы.

Проект построен по нестандартной для Laravel структуре, что позволило оставить пространство для масштабирования, а так же четко выделить зоны ответственности того или инного кода. Проект разделен на модули, а модули внутри себя имеют слоистую архитектуру.

## Установка зависимостей

Перед началом работы убедитесь, что у вас установлены:

- [PHP](https://www.php.net/) (версия ^8.2)
- [Composer](https://getcomposer.org/) (Версия ^2.6)
- [Node.js](https://nodejs.org/) (версия ^16.20)
- [npm](https://www.npmjs.com/) (версия ^8.19)
- [Git](https://git-scm.com/)

### 1. Клонирование репозитория

```bash
git clone https://github.com/PeterBerestnev/Exchange.git
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

Ключ можно получить при регистрации по ссылке https://openexchangerates.org/signup/free

### 5. Генерация ключа приложения
```bash
php artisan key:generate
```
### 6. Запуск сервера разработки
```bash
php artisan serve
```