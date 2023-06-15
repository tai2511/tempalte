<?php

namespace design;

use design\algorithm\DrivingAlgorithm;

class Car extends Vechile{
	public function __construct(){
		$this->setAlgorithm(new DrivingAlgorithm());
	}
}
