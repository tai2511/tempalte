<?php

namespace design;

use design\algorithm\FlyingAlgorithm;

class Plane extends Vechile{
	public function __construct(){
		$this->setAlgorithm(new FlyingAlgorithm());
	}
}