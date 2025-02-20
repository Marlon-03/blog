# Project Setup Instructions

Follow these steps to set up the project:

1. **Install Dependencies:** Use the command `composer install` to install the necessary dependencies in the server side.

1. **Install Dependencies:** Use the command `npm install` to install the necessary dependencies in the client side.

2. **Environment Setup:** Copy the example environment file to create your own. Use the command `cp .env.example .env`.

3. **Generate Application Key:** Generate a unique key for your application with `php artisan key:generate`.

4. **Database Migration:** Create the database tables by running `php artisan migrate`.

5. **Seed Roles:** Populate the Roles table with `php artisan db:seed RolesTableSeeder`.

6. **Seed Users:** Populate the Users table with `php artisan db:seed AdminUserSeeder`.

7. **Image Upload:** To use storage in public to for images `php artisan storage:link`.

8. **Start Server:** Start the Laravel development server with `php artisan serve` for server side.

8. **Start Server:** Start the Vue Js server with `npm run dev` for client side.

9. **Access Application:** Open your web browser and go to `localhost:8000` to access the application.