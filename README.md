# Car dealership Symfony application

## Description

This repository was created for a technical test.
Context: a car dealer created his business recently. To increase his visibility, he wants to create an application to display the cars he sells. 

Here are the requirements:
- a single page application as simple as possible
- a search input field to find the cars by name and filters to find the cars by category
- pagination to avoid having all the results on a single page
- the weather must be display on the main page and the temperature must change every hour 
- an administration page to update, create, read, and delete cars

You can find a demo of the application here:
https://www.loom.com/share/d07402283c274c4baadb99fcc74a07f3

To build this app, I used Symfony 6.3.0.
Here are the steps to use the application :

## Steps

1. Clone the repo from Github
2. Run `composer install` and `yarn install` in your CLI
3. Create and configure _.env.local_ from _.env_ file and add your database parameters by entering your mySQL credentials and the name of your database
4. Run `symfony console doctrine:database:create` to create your database 
5. Run `symfony console doctrine:migrations:migrate` to import the content of the database app
6. Run `symfony console doctrine:fixtures:load` to import the fixtures into the database
7. Run the internal Symfony webserver with `symfony server:start`
8. Run `yarn build` and then `yarn dev-server` to launch Webpack
8. Go to `localhost:8000` with your favorite browser.

For more info about setting up an existing Symfony project, you can read the following documentation:
https://symfony.com/doc/current/setup.html#setting-up-an-existing-symfony-project