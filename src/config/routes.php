<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/* @var $app \Silex\Application */

$routes = $app['controllers_factory'];

$routes->match('/', '\BaseController::showWelcome')
    ->method('GET|POST')
    ->bind('index');

$routes->get('/{page}', '\BaseController::showPageContent')
    ->bind('page');

$routes->get('/wp-content/uploads/{year}/{month}/{slug}', '\BaseController::showAssetContent')
    ->bind('asset');

$blogPosts = array(
    1 => array(
        'date'      => '2011-03-29',
        'author'    => 'igorw',
        'title'     => 'Using Silex',
        'body'      => '...',
    ),
);

$app->get('/blog', function () use ($blogPosts) {
    $output = '';
    foreach ($blogPosts as $post) {
        $output .= $post['title'];
        $output .= '<br />';
    }

    return $output;
});



$app->mount('/', $routes);