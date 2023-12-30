# Drupal TMDB

This is a [Drupal](https://www.drupal.org) practice project bootstrapped with [Composer](https://getcomposer.org).

## Detail

1. It is a simple Drupal web app to display movie list.
2. Imports data from a JSON feed [TMDB API](https://developer.themoviedb.org/docs).
3. Create a custom content type called `movie`.
4. Create a custom corn to fetching JSON data hourly and save data a node.
5. Using Bootstrap to implement appearance.
6. Create a custom twig to display image that comes from external url.
7. Create a admin config page `/admin/config/movies` to modify api url and run corn to fetch data manually.
8. Create a view to display moive list and set it as a home page.
9. User name and password for drupal web app and mysql is `drupal`.

## Development Environment

* MacOS Sonoma 14.2.1
* MAMP 6.8.1
  * Apache 2.4.54
  * PHP 8.2.0
  * MySQL 5.7.39

## Technologies used

* Composer 2.6.6
* Drupal 10.2.0

## Other Modules used

1. [Drush](https://www.drush.org/12.x/)
2. [Bootstrap5](https://www.drupal.org/project/bootstrap5)

## Setup MAMP

Step 1: Add user in MySQL For Drupal project.

At the MySQL prompt, create the user and set the permissions using the following command:

```bash
CREATE USER 'drupal'@'localhost' IDENTIFIED BY 'drupal';

GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX ON *.* TO 'drupal'@'localhost';

GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, REFERENCES, INDEX, LOCK TABLES ON `drupal`.* TO 'drupal'@'localhost';
```

Step 2: Create database named `drupal_tmdb`.

Step 3: Using `phpMyAdmin` to import database.

Note: using phpMyAdmin to import sql, might got warning message like this

 `You probably tried to upload too large file. Please refer to documentation for ways to workaround this limit.`

So following limits in the `php.ini` file.

```bash
post_max_size = 100M
upload_max_filesize = 100M
max_execution_time = 300
memory_limit = 1000M
```

Step 4: Move the folder of project to the MAMP

Step 5: Port setting in MAMP:

```bash
Apache: 80
MySQL: 3306
```
