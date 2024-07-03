<?php
$routes = [
    // punya home
    '/' => 'HomeController@index',
    '/dumy' => 'HomeController@img', 
    '/search' => 'HomeController@search', 
    '/style' => 'HomeController@searchStyle', 

    // punya user
    '/user/profile' => 'UserController@profile',
    '/auth' => 'AuthController@index',
    '/logout' => 'AuthController@logout',
    '/register' => 'AuthController@register',
];

return $routes;
?>