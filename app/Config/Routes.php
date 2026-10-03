<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('trails', 'Trails::index');
$routes->get('trails/new', 'Trails::new');
$routes->post('trails', 'Trails::create');
$routes->get('trails/(:num)', 'Trails::show/$1');
$routes->get('trails/(:num)/edit', 'Trails::edit/$1');
$routes->post('trails/(:num)/update', 'Trails::update/$1');
$routes->post('trails/(:num)/delete', 'Trails::delete/$1');
$routes->get('api/trails/search', 'Api\TrailSearch::index');
$routes->get('weather', 'Weather::index');
$routes->get('api/weather', 'Weather::forecast');
$routes->get('favourites', 'Favourites::index');
$routes->post('api/favourites/(:num)', 'Favourites::toggle/$1');
$routes->get('reviews/(:num)', 'Reviews::index/$1');
$routes->post('api/reviews/(:num)', 'Reviews::create/$1');
