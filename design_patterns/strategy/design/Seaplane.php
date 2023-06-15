<?php

namespace design;

use design\algorithm\SwingingAlgorithm;

class Seaplane extends Vechile{
	public function __construct(){
		$this->setAlgorithm(new SwingingAlgorithm());
	}
}