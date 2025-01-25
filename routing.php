<?php

$routing = [
    '/' => 'GalleryController@index',
    '/index' => 'GalleryController@index',
    '/gallery' => 'GalleryController@index',
    '/view' => 'GalleryController@view',
    '/saved' => 'GalleryController@saved',
    '/upload' => 'UploadController@upload',
    '/search' => 'SearchController@search',
    '/login' => 'AuthController@login',
    '/register' => 'AuthController@register',
    '/logout' => 'AuthController@logout',
    '/api/search' => 'SearchController@search_img',
];
