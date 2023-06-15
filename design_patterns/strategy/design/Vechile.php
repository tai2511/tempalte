<?php

namespace design;

use design\algorithm\IGo;

abstract class Vechile{

	protected $algorithm;

	public function setAlgorithm(IGo $algorithm){
		$this->algorithm = new $algorithm();
	}

	public function go(){
		$this->algorithm->go();
	}
}