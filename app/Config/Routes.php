<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->match(['GET', 'POST'], 'inscription', 'Auth::inscription');
$routes->match(['GET', 'POST'], 'connexion', 'Auth::connexion');
$routes->get('tableau-de-bord', 'Dashboard::index');
$routes->get('deconnexion', 'Auth::deconnexion');
$routes->match(['GET', 'POST'], 'cours/ajouter', 'Cours::ajouter');
$routes->get('cours', 'Cours::index');
$routes->match(['GET', 'POST'], 'quiz/ajouter', 'Quiz::ajouter');