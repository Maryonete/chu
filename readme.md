# Hospital SoigneMoi


## Description

SoigneMoi is an application developed by **Develop-Solution** for the SoigneMoi hospital, located in the Lille region of France. This application aims to improve the efficiency of the hospital by providing computerized tools for managing admissions, stays, and medical prescriptions.

## Technologies Used

- PHP 8.2.12 (CLI)
- Symfony 6.4
- Composer
- MySQL

## Features

The SoigneMoi web application allows users to create an account, schedule their hospital stay, and view their stay history. Administrators can manage doctor schedules by creating doctors and setting their schedules.

## Online Usage

To use the application online, please visit the following link:

```bash

https://soignemoi-chu-19a585dde838.herokuapp.com

```

## Local Installation

### Prerequisites

Make sure you have the following installed before you begin:

- GIT
- PHP 8 ou plus
- Composer
- Symfony CLI
- NodeJS : yarn ou nmp

### Installation

1. Clone this repository to your local machine:

```bash
    git clone https://github.com/Maryonete/chu
```

2. Navigate to the project directory:

```bash
    cd chu
```

3. Install dependencies with Composer:

```bash
    composer install
```

4. Install dependencies:

```bash
    yarn install
    or
    npm install
```

5. Modify the .env file at the root of the project with your database information and add the following variables:

```bash
    ### Data base access ###
    DATABASE_URL= Your Database
```

6. Create the database:

```bash
  php bin/console doctrine:database:create
```

7. Run migrations and create the database structure:

```bash
  php bin/console doctrine:migrations:migrate -n
```

8. Insert records into the database

```bash
  php bin/console doctrine:fixtures:load -n
```

9. Start the Symfony server

```bash
  symfony serve
```

10. Build the project

```bash
  yarn run build
ou
  npm run build
```

11. Finally, access the application:

```bash
  https://localhost:8000
   or the address defined in your web server configuration
```

## Usage

#### Test User Credentials

- **Patient**:

  - Email: john.do@test.fr
  - Password: test

- **Administrator**:
  - Email: admin@studi.fr
  - Password: test
