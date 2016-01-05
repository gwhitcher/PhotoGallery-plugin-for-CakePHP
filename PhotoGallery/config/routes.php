<?php
use Cake\Routing\Router;

Router::plugin('PhotoGallery', function ($routes) {
    //$routes->fallbacks();
    //This is the same as above just here to customize if needed.
    $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'InflectedRoute']);
    $routes->connect('/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);
});
