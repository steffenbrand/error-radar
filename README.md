# Error Radar

Error Radar is a dashboard to monitor plans from various build servers that you can use on a big screen in your office.

## Currently supported build servers

- Bamboo (tested with 6.1.1)

## Planned build servers

- Jenkins
- Travis CI

## Screenshots

#### Dashboard
![Dashboard](https://github.com/steffenbrand/error-radar/blob/master/screenshots/dashboard.jpg?raw=true)

#### Settings
![Settings](https://github.com/steffenbrand/error-radar/blob/master/screenshots/settings.jpg?raw=true)

## Installation

### Requirements

- PHP >= 7.0
- A database, peferably MySQL (other databases supported by CakePHP3 are fine as well)
- A webserver, preferably nginx or Apache 2.4 (Installation and configuration of your webserver is not part of this installation guide)

### Get composer

See https://getcomposer.org/

### Install application

Go to your desired installation directory and run the following command, to install the application using composer.

```
composer create-project steffenbrand/error-radar error-radar
```

Alternatively you could clone the git repository and run `composer install` afterwards.

### Create an empty database
- Preferably MySQL
- utf8_general_ci
- InnoDB

### Configure database

Edit the config/app.php file.

```
cd error-radar
nano config/app.php
```

At the top of the file you will find the Datasources array.  
Edit the configuration to your needs and save.

```
////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CONFIGURE YOUR DB CONNECTION HERE ///////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
'host'      => 'localhost',
'username'  => 'my_app',
'password'  => 'secret',
'database'  => 'my_app',
'port'      => '3306',
'driver'    => 'Cake\Database\Driver\Mysql',
////////////////////////////////////////////////////////////////////////////////////////////////////////////
```

### Migrate and seed database

Run the following commands from the applications root directory to create the database and insert a default admin user.

```
bin/cake migrations migrate
bin/cake migrations seed
```

### Go for it

Login and create your categories, configure your servers and add plans.
The admin default credentials (please change them immediately) are as follows:

```
user: admin
password: password
```

## Security concerns

Error Radar stores the build servers passwords (encrypted) in the database, so make sure to ...

- create and use accounts that have only READ access to the build servers REST API.
- make it reachable only within your network.
- separate the application server from the database server.