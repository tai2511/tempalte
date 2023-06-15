<?php

class Node {
	public $data;
	public $next;

	function __construct($d) {
		$this->data = $d;
		$this->next = NULL;
	}
}

class LinkedList {
	function insert($head, $data) {
		$p = new Node($data);
		if ($head == NULL) {
			$head = $p;
		} else {
			$start = $head;
			while ($start->next != NULL) {
				$start = $start->next;
			}
			$start->next = $p;
		}
		return $head;
	}

	function display($head) {
		$start = $head;
		while ($start) {
			echo $start->data, ' ';
			$start = $start->next;
		}
	}
}

$llist = new LinkedList();
$head = NULL;
$head = $llist->insert($head, 1);
$head = $llist->insert($head, 2);
$head = $llist->insert($head, 3);
$head = $llist->insert($head, 4);
$head = $llist->insert($head, 5);
$llist->display($head);