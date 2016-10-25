# Microservice responsible for proxying requests to Solr

> This service is a part of the Druply.me project. It is a tiny API in front of the Solr.

=============

A Symfony 3 project created on August 18, 2016, 9:08 pm.

## Installation

* Install dependencies with Composer `composer install`
* Use app.php as index `ln -s web/app.php web/index.php`
* Create Doctrine database schema `bin/console doctrine:schema:create`
* Fetch projects list `bin/console app:fetch`
* Index projects `bin/console app:index`
