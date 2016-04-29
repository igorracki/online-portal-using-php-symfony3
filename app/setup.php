<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Templates path for twig
$templatesPath = __DIR__ . '/../templates';

// Setup Twig
$loader = new Twig_Loader_Filesystem($templatesPath);
$twig = new Twig_Environment($loader);

// Setup Silex
$app = new Silex\Application();


$app->register(new \Silex\Provider\SessionServiceProvider());
// Register Twig with Silex
$app->register(new Silex\Provider\TwigServiceProvider(), array(
   'twig.path' => $templatesPath
));