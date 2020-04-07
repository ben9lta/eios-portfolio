<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.com/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.com/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```

Для создания бота для регистрации
'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mail.ru',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'Email',
                'password' => 'Пароль',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
        ],

И в common/config/params.php - изменить значение у свойства 'supportEmail'




sudo apt-get install apache2 mysql-client mysql-server php7.2 
sudo apt-get install php7.2-curl php-mbstring php-dom php-gd php-mysql

#Клонирование репозитория
git clone https://github.com/ben9lta/eios-portfolio.git 
# зайти в дерикторию
# cd GIT

#Обновлнеие и установка пакетов
composer update
composer install

#инициализация проекта
php init

#Сюда прописывать БД
#common/config/main-local.php

sudo a2ensite <ИМЯ ФАЙЛА КОНФИГУРАЦИЙ>

#Если апачь не запускается после выполненения "sudo a2ensite site"
#sudo a2enmod rewrite
#sudo service apache2 restart

#магия, может надо может нет
#composer global require "fxp/composer-asset-plugin:~1.0.3"

# для того чтобы работал rbac
composer require mdmsoft/yii2-admin "~2.0"

#миграции для rbac
./yii migrate --migrationPath=@mdm/admin/migrations
./yii migrate --migrationPath=@yii/rbac/migrations
./yii rbac/init
./yii migrate
