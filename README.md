# Eleven Soft Backend Refactoring Test

Welcome to the Eleven Soft Backend Refactoring Test repository! This Laravel-based project is designed to evaluate your backend skills, particularly in refactoring and improving the existing codebase.

## Getting Started

To begin the test, follow the steps outlined below:

### Prerequisites

Ensure that you have the following prerequisites installed on your local machine:

- PHP (>= 8.1)
- Composer
- Docker

### Installation and Setup

Ensure that docker is running on your local machine.

1. Clone this repository to your local machine:

   ```bash
   git clone https://github.com/elevensoft-dev/backend-refactoring-test.git
   ```

2. Change to the project directory:

   ```bash
   cd backend-refactoring-test
   ```

3. Install and configure the project:

   ```bash
   make install
   ```

4. Start the Docker containers:

   ```bash
   make up
   ```

The application will be accessible at `http://localhost:8000`.

### Documentation

The API is documented using Swagger. Ensure that your refactoring maintains or improves the clarity of the API documentation. The Swagger documentation can be accessed at `http://localhost:8000/api/documentation`.

### Useful Makefile Targets

- `make ps`: Show Docker container status.
- `make down`: Stop and remove Docker containers.
- `make forget`: Stop and remove Docker containers, volumes, and MySQL data.
- `make api-shell`: Access the API container shell.
- `make api-test`: Run PHPUnit tests.
- `make api-test-feature`: Run PHPUnit tests for the Feature suite.
- `make api-test-php-unit`: Run PHPUnit tests specifically.

### Submission Guidelines

1. Create a new branch for your changes:

   ```bash
   git checkout -b feature/refactoring-changes
   ```

2. Make your changes and commit them:

   ```bash
   git commit -m "Refactor code for improved readability and maintainability"
   ```

3. Push your changes to your forked repository:

   ```bash
   git push origin feature/refactoring-changes
   ```

4. Open a pull request against the main repository.

## Questions and Support

If you have any questions or need assistance during the test, please send an email to [Eleven Soft Support](mailto:dev_tests@elevensoft.dev).

You can also reach us on WhatsApp: [Eleven Soft WhatsApp](https://wa.me/5548988168221).

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

