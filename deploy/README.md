# Toyota VR Installation Share Page

## Front-end files
All front-end files that need to be deployed can be placed in the
directory `deploy/htdocs/static`. The name of the `static` directory
is arbitrary and can be changed to whatever you prefer.

The main lay-out template (the one that will be served by Symfony), can
be found at 
`deploy/src/App/FrontEndBundle/Resources/views/layout.html.twig`.
Additional templates may be created in the `Home` directory if
necessary.

## Composer
The application uses Composer to manage depedencies. In order to make
the application work, please execute a `composer install` from the
`deploy` directory in order to install the relevant dependencies.

## Database
In order to use the application you need to configure your local
database. This requires you to follow these steps: 

### 1. Adding your host to environments.php
The application determines what environment (development, testing,
UAT or production) it is hosted in by examining the current host. A
switch statement in the file `app/environment.php` determines which
host corresponds to which environment. If the host was not recognized
the application will assume it is hosted in the production environment.

When developing locally, you can inform your application about this by
adding your host to the first case in the switch statement. If your host
is `localhost` or `127.0.0.1` you don't need to configure anything
here, but if you use a different host (for example
'toyota-vr-installation-share-page.local') adding it to the switch
statement is required.

You can also override the environment by setting an environment variable
called `ENVIRONMENT`. For example:

`export ENVIRONMENT="production"`

This can be useful when interacting with the application on the command
line.

### 2. Creating the database.
You need to create a MySQL database that will be used locally for the
application. You can use any name for the database, but I suggest
something like 'toyota-vr-installation-share-page'.

### 3. Creating the local parameters file.

1. Copy the file `deploy/app/config/parameters_example.yml` to 
`deploy/app/config/parameters_development.yml`.
2. In the `parameters_development.yml` you just created, replace
the example database credentials with the credentials of the database
you created during step 2.

### 4. Execute the migrations.
To actually create the tables in your database you can use the
migrations functionality provided by Doctrine and Symfony.

1. Make sure you can access the Symfony console and that the console
recognizes your development environment. The console can be accessed
by executing the file `bin/console` on the command line.
2. Execute `doctrine:migrations:migrate` to migrate the database to the
most recent version.
3. In the future, if the application is showing errors related to the
database, make sure to run `doctrine:migrations:migrate` again first to
make sure the database is up-to-date.

If you would like some more information about Doctrine migrations in
Symfony, check out (the documentation)[http://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html]

## Installing assets
The API documentation requires assets to be installed (if you notice
CSS and JavaScript files are missing in the API documentation, this is
most likely the problem). The assets can be installed by executing
`bin/console assets:install htdocs --symlink` from inside the `deploy`
directory.

## Clearing the cache
If you want to clear the back-end cache, execute
`bin/console cache:clear`. Alternatively, you can simply delete the
relevant directory in the `var/cache` directory.
