<?php
spl_autoload_register(function($className) {
	$className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
	include_once $_SERVER['DOCUMENT_ROOT'] . '/template/' . $className . '.php';

});
define("TMPPATH", dirname(__FILE__). "/tmp");
if (!file_exists(TMPPATH)) {
	mkdir(TMPPATH, 0777, true);
}
$a = design_patterns\pool\PoolSql::getInstance();
$con = $a->getPoolConnection();

$tien = 5.0;
$count = 0;
while ($tien < 20) {
	$tien = $tien + $tien * 0.07;
	echo $tien . "--";
	$count++;
}
echo "<pre>";
print_r($count);
echo "</pre>";
die;