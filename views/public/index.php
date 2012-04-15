<?php
ini_set('display_errors', true);

// Global constants
define('DIR_SEP', DIRECTORY_SEPARATOR);
define('LIBS_DIR',        realpath('.') . DIR_SEP . '..' . DIR_SEP . 'libs' . DIR_SEP);
define('CONTROLLERS_DIR', realpath('.') . DIR_SEP . '..' . DIR_SEP . 'controllers' . DIR_SEP);
define('VIEWS_DIR',       realpath('.') . DIR_SEP . '..' . DIR_SEP . 'views' . DIR_SEP);

// Essentials
require (LIBS_DIR . 'phaste' . DIR_SEP . 'phaste.php');

$urls = array('/'                          => 'index:index',
              '/garage'                    => 'garage:index',
              '/garagem'                   => 'garage:index',
              '/doAuth'                    => 'mozillabrowserid:triggerAuth',
              '/doMozLogout'               => 'mozillabrowserid:SessKill',
              '/article/view/[a-zA-Z0-9]+' => 'article:viewArticle',
             );

phaste::stick($urls, CONTROLLERS_DIR, '_controller.php');
