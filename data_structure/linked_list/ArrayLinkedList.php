<?php

$list = array();
$head = &$list;

$node1 = array('data' => 1, 'next' => null);
$node2 = array('data' => 2, 'next' => null);
$node3 = array('data' => 3, 'next' => null);

$head['next'] = &$node1;
$node1['next'] = &$node2;
$node2['next'] = &$node3;

$node = $head['next'];
while ($node != null) {
	echo $node['data'] . "\n";
	$node = $node['next'];
}