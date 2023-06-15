<?php

spl_autoload_register(function($className) {
	include_once $className . '.php';
});

$app = new app\App();
$app->main();