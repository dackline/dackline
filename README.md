# _Dackline_

## Installation

Clone the repository and Install the dependencies.

```sh
composer install

npm install
npm run dev

php artisan key:generate

php artisan migrate

php artisan db:seed --class=OrderStatusSeeder
php artisan db:seed --class=RolesAndPermissionsSeeder
php artisan db:seed --class=QuotationStatusSeeder

# Generate admin user
php artisan make:user
```

If you are using laravel sail make sure to follow following steps:

```sh
sail composer install

sail npm install
sail npm run dev

sail artisan key:generate

sail artisan migrate

sail artisan db:seed --class=OrderStatusSeeder
sail artisan db:seed --class=RolesAndPermissionsSeeder
sail artisan db:seed --class=QuotationStatusSeeder

# Generate admin user
sail artisan make:user
```
