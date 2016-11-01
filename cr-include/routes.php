<?php
    //HOME PAGE WITHOUT MULTI LANGUAGE
    $router->map( 'GET', '/', function() { require __DIR__.'/../home.php'; }, 'home');
    //HOME PAGE WITH MULTI LANGUAGE
	$router->map( 'GET', '/[a:lang]/', function($lang) { require __DIR__.'/../home.php'; }, 'home-lang');

    //SETUP PAGE ROUTES
    $router->map( 'GET', '/setup/', function() { require __DIR__.'/../setup-page.php'; }, 'setup');
    $router->map( 'GET', '/setup/step/[i:step]/', function($step) { require __DIR__.'/../setup-page.php'; }, 'setup-step');

    //BACK END ROUTES
    $router->map( 'GET', '/cr-admin/', function() { require __DIR__.'/../cr-admin/login.php'; }, 'admin-login');
    $router->map( 'GET', '/cr-admin/dashboard/', function() { require __DIR__.'/../cr-admin/dashboard.php'; }, 'admin-dashboard');
    $router->map( 'GET', '/cr-admin/dashboard/[:section]/', function($section) { require __DIR__.'/../cr-admin/dashboard.php'; }, 'admin-dashboard-section');
    $router->map( 'GET', '/cr-admin/dashboard/[:section]/[:action]/', function($section, $action) { require __DIR__.'/../cr-admin/dashboard.php'; }, 'admin-dashboard-action');
    $router->map( 'GET', '/cr-admin/dashboard/[:section]/[:action]/[:id]/', function($section, $action, $id) { require __DIR__.'/../cr-admin/dashboard.php'; }, 'admin-dashboard-id');
    $router->map( 'GET', '/cr-admin/dashboard/[:section]/[:action]/[:id]/[:extra]', function($section, $action, $id, $extra) { require __DIR__.'/../cr-admin/dashboard.php'; }, 'admin-dashboard-extra');

    /*
    //FRONT END ROUTES WITHOUT MULTI LANGUAGE
    $router->map( 'GET', '/[:page]/', function($page) { require __DIR__.'/../home.php'; }, 'specific-page');
    $router->map( 'GET', '/[:page]/[:id_link]/', function($page, $id_link) { require __DIR__.'/../home.php'; }, 'id-link');
    $router->map( 'GET', '/[:page]/[:id_link]/[:more_link]/', function($page, $id_link, $more_link) { require __DIR__.'/../home.php'; }, 'more-link');
    $router->map( 'GET', '/[:page]/[:id_link]/[:more_link]/[:extra_link]/', function($page, $id_link, $more_link, $extra_link) { require __DIR__.'/../home.php'; }, 'extra-link');
    */

    //FRONT END ROUTES WITH MULTI LANGUAGE
    $router->map( 'GET', '/[a:lang]/[:page]/', function($lang, $page) { require __DIR__.'/../home.php'; }, 'specific-page-lang');
    $router->map( 'GET', '/[a:lang]/[:page]/[:id_link]/', function($lang, $page, $id_link) { require __DIR__.'/../home.php'; }, 'id-link-lang');
    $router->map( 'GET', '/[a:lang]/[:page]/[:id_link]/[:more_link]/', function($lang, $page, $id_link, $more_link) { require __DIR__.'/../home.php'; }, 'more-link-lang');
    $router->map( 'GET', '/[a:lang]/[:page]/[:id_link]/[:more_link]/[:extra_link]/', function($lang, $page, $id_link, $more_link, $extra_link) { require __DIR__.'/../home.php'; }, 'extra-link-lang');

?>