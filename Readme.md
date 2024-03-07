# MiniAppSymfony4

## Installation

1. Clone the repository.
2. Run `composer install` to install the dependencies.
3. Run `php bin/console doctrine:database:create` to create the database.
4. Run `php bin/console doctrine:migrations:migrate` to run the database migrations.

## Usage

### Admin Login

To access the admin panel, navigate to `/registration` route.

### User Login

To log in as a standard user, go to `/login` route.

### Creating a Company

1. Log in as an admin.
2. Navigate to the admin panel.
3. Find the option to create a new company.
4. Fill in the required details and submit the form.

### Creating Standard Users

1. Log in as an admin.
2. Go to the admin panel.
3. Look for the option to create new standard users.
4. Provide the necessary information and save the user.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvement, please open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

Symfony Version: 4.4
Easy Admin Version: 3.5.3
