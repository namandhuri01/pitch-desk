Application Deployment Steps
Clone project from git repository https://github.com/namandhuri01/pitch-desk.git

Run command composer install.

Copy .env.example file to .env.

Set database configuration in .env file of application.

Set APP_URL value in .env file.

Set SMTP configuration in .env file.

Run migration command php artisan migrate

Run seeder command php artisan db:seed

Run Command php artisan storage:link

Run Command php artisan passport:install to create the encryption keys needed to generate secure access tokens
