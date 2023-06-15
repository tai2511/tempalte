<?php

namespace data_structure\stack_queue;

use IStackQueue;

class ArrayStack implements IStackQueue {

	private array $stack;
	private int $size;
	private int $topIndex = -1;

	public function __construct($size){
		$this->size = $size;
		$this->stack = [];
	}

	public function push($value){
		if (!$this->isFull()) {
			$this->topIndex++;
			$this->stack[$this->topIndex] = $value;
			return true;
		}
		return false;
	}

	public function pop(){
		if (!$this->isEmpty()) {
			$value = $this->stack[$this->topIndex];
			$this->topIndex--;
			return $value;
		}
		return null;
	}

	public function isEmpty(){
		return $this->topIndex < 0;
	}

	public function isFull(){
		return $this->topIndex == $this->size;
	}
}
