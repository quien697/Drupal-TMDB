# Drupal TMDB

This is a [Drupal](https://www.drupal.org) practice project bootstrapped with [Composer](https://getcomposer.org).

## Detail

1. It is a simple Drupal web app to display movie list.
2. Imports data from a JSON feed [TMDB API](https://developer.themoviedb.org/docs).
3. Create a custom content type called `movie`.
4. Create a custom cron to fetching JSON data hourly and save data a node.
5. Using Bootstrap to implement appearance.
6. Create a custom twig to display image that comes from external url.
7. Create a admin config page `/admin/config/movies` to modify api url and run cron to fetch data manually.
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
* Drupal 10.2.1

## Other Modules used

1. [Drush](https://www.drush.org/12.x/)
2. [Bootstrap5](https://www.drupal.org/project/bootstrap5)

## Getting Started

1. Move the project to `/Users/YOUR USER NAME/Sites/Drupal-TMDB-main/web` or `/Application/MAMP/htdocs/Drupal-TMDB-main/web`. It is depending on your MAMP is free or pro. And then setting document root on MAMP.

2. Install all of the dependencies

   ```
   # composer install
   ```

3. Create a database

   ```
   # /Applications/MAMP/Library/bin/mysql -u root -p
   ```

   ```mysql
   mysql> CREATE DATABASE drupal-tmdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   ```

4. Create a user for database

   ```mysql
   mysql> CREATE USER drupal@localhost IDENTIFIED BY 'drupal';
   mysql> GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES ON drupal-tmdb.* TO 'drupal'@'localhost' IDENTIFIED BY 'drupal';
   mysql> FLUSH PRIVILEGES;
   ```

5. Import database

   ```
   # /Applications/MAMP/Library/bin/mysql -u root -p drupal-tmdb < ~/Sites/Drupal-TMDB-main/sql/drupal_tmdb.sql
   ```

6. Start server on MAMP and open [http://localhost/core/install.php](http://localhost/core/install.php) with your browser to reinstall Drupal. And you might get messages like below, so you can press `update script` link or open [http://localhost/update.php](http://localhost/update.php) to complete database update.

   Drupal already installed

   - To start over, you must empty your existing database and copy default.sertting.php over settings.php.
   - To upgrade an existing installation, proceed to the [update script](http://localhost/update.php).
   - View your [existing site](http://localhost).

7. Option steps, because of installing all of dependencies, two custom twigs in bootstrap5 will be reset, so there are two files must copy to the project.

   /Drupal-TMDB-main/web/themes/contrib/bootstrap5/templates/views/views-view-grid--movies.html.twig

   /Drupal-TMDB-main/web/themes/contrib/bootstrap5/templates/field/field--field-image-url.html.twig
