<?php

use Slim\App;
use App\Controllers\Home;

/**
 * Routing rules are defined here.
 * 
 * @var App $app
 */

$app->get('/', Home::class.':index');