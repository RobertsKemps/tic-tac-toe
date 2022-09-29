# Tic tac toe game

Developed by [**Roberts Kemps**](https://lv.linkedin.com/in/robertskemps)

The project was developed using:
- [Composer](https://getcomposer.org/download/) (will be needed on local machine to run the project)
- [Docker](https://www.docker.com/) (will be needed on local machine to run the project)
- [Laravel Sail](https://laravel.com/docs/9.x/sail) (will be installed with `composer install` command)

### Detailed development information
- [Composer](https://getcomposer.org/download/) v2.4.2
- [Docker](https://www.docker.com/) v4.12.0
  - [PHP](https://www.php.net/) v8.1.10
  - [MySQL](https://www.mysql.com/) v8.0.30
  - [NodeJs](https://nodejs.org/en/) v16.17.0
  - [npm](https://www.npmjs.com/) v8.19.2
- [Laravel](https://laravel.com/docs/8.x/installation) v9.31.0

# Setup

```bash
composer install

cp .env.example .env

./vendor/bin/sail build --no-cache
./vendor/bin/sail up -d

./vendor/bin/sail npm install 
./vendor/bin/sail npm run dev

./vendor/bin/sail artisan migrate
```

After these steps the project should be up and running.
