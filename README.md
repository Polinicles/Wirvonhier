# Wirvonhier


![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)
![PHP](https://img.shields.io/badge/php-7.2-brightgreen.svg)
![SYMFONY](https://img.shields.io/badge/symfony-4.1-red.svg)
![DOCKER](https://img.shields.io/badge/docker-3-yellow.svg)
![PHPUNIT](https://img.shields.io/badge/phpunit-7.5-green.svg)

The following instructions will allow to run the Wirvonhier test in a Docker container using **nginx**, **php 7.2** and **Symfony**.


## Getting Started

### Prerequisites

Make sure you have [Docker](https://www.docker.com/) installed in your system.

### Initialize environment

After cloning this repository we can build the docker container by using

```
docker-compose -f docker.dev.yml up --build
```

If it has been succesful, the `http://localhost:8080` should display the **HomeController** default page. 

### Connect to container

For the next steps, we must connect to the running container

```
docker exec -ti wirvonhier_php bash
```

### Migrate to the DB

Once connected to the docker container, a database will have been created but it needs the migrations to create the necessary tables

``` php bin/console doctrine:migrations:migrate ```

### Populate with fake records

In order to have some data by default, there's a ```DataFixtures``` file that will allow you to start with some entities


``` php bin/console doctrine:fixtures:load ```

It's recommended to use this command before adding data because it will delete all previous entities stored in the DB.

### Connect to MySQL container

To check the records, connect to the MySQL DB using:

host=`127.0.0.1`
user=`root`
password=`passwd`
database=`core`
port=`33066`

## Routes

The following routes have been added to perform the actions

| Route       | Description          | Params  | Type |
|  :-----: | :-----:| :-----:| :-----:|
| /event/     | create a new event |type, place | POST |
| /event/radius={radius}&latitude={latitude}&longitude={longitude}      | Find the nearest events within a radius     |  radius, latitude, longitude  | GET |
| /event/{id} | get event by ID | id | GET |
| /place     | create a new place |type, latitude, longitude | POST |

The routes can be tested using [Postman](https://www.getpostman.com/). **Remember** using the `http://localhost:8080` url.

All the routes will prove a **json** response type and will make sure the params given match the entities attributes type. In case of an **error**, it will also response with the specific code and error message.

## Testing

Some tests are provided to make sure the application is works as expected. To execute them use

```./vendor/bin/phpunit```


