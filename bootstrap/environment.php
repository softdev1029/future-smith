<?php

/*
|--------------------------------------------------------------------------
| Follow this instructions:
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
| 1. Check if you have .env file (it should be automatically created by laravel)
|
| REMOVE all the contents from here, and just put: local or production
| (whatever environment you want). This will be the one that will be 
| changed when you want to switch to another environment. :D
|
| 2. Create new Environment file let say you have your local and production enviroment.
|
| Create a file with the name of: .local.env
| Create a file with the name of: .production.env
|
| 3. Add default environment value.
|
| For Local Environment (.env.local file)
| APP_ENV=local
|
| For Production Environment (.env.production file)
| APP_ENV=production
|
| 4. Create new php file and named it, environment.php, save it into this folder: app/bootstrap/environment.php
| – Inside of this file we will do the magic. Insert this snippet code.
*/

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
*/

$env = $app->detectEnvironment(function(){
    $environmentPath = __DIR__.'/../.env';
    $setEnv = trim(file_get_contents($environmentPath));
    if (file_exists($environmentPath)) {
        putenv("$setEnv");
        if (getenv('APP_ENV') && file_exists(__DIR__.'/../.env.' . getenv('APP_ENV'))) {
        	$dotenv = new Dotenv\Dotenv(__DIR__ . '/../', '.env.' . getenv('APP_ENV'));
        	$dotenv->load();
        } 
    }
});

$app->afterLoadingEnvironment(function() use($app) {
    if (getenv('APP_ENV') && file_exists(__DIR__.'/../.env.' . getenv('APP_ENV'))) {
        $dotenv = new Dotenv\Dotenv(__DIR__ . '/../', '.env.' . getenv('APP_ENV'));
        $dotenv->overload();
    }
});