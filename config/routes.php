<?php
$routes = [
    '/' => 'HomeController@index',
    '/user/profile' => 'UserController@profile',
    '/login' => 'AuthController@login',
    '/logout' => 'AuthController@logout',
    '/register' => 'AuthController@register',
];

return $routes;
?>