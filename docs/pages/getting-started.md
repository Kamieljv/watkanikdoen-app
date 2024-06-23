# Getting started

## Deployment Instructions

### X. Install dependencies
- PHP: Install PHP 8.2 and the required extensions 
- NPM: 
### X. Install PHP packages
- Install composer (PHP package manager) using `sudo apt install composer`
### X. Run a local MySQL database
- 
### 1. Set up the database
- Create a database and add the connection details to `.env`
- Run migrations with `php artisan migrate`
- Run seeders with `php artisan db:seed`

### X. Build the frontend
- Run `npm install` to install the node packages
- Run `npm run watch` to start the webpack compiler

### 2. Run the server

- Run the server with `php artisan serve`

### 3. Log in using the admin account

- Log in with the username `admin@admin.com` and password `admin12345`. Change the password after logging in.