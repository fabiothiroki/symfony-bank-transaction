# symfony-bank-transaction
[![Symfony](https://github.com/fabiothiroki/symfony-bank-transaction/actions/workflows/symfony.yml/badge.svg)](https://github.com/fabiothiroki/symfony-bank-transaction/actions/workflows/symfony.yml)

Example application simulating the transfer of money between bank accounts

## Local development
Start docker dependencies:
```bash
docker-compose up
```

Install php dependencies
```bash
composer install
```

Run migrations
```bash
php bin/console doctrine:migrations:migrate
```

Run the application
```bash
symfony serve
```