<?php

interface IStackQueue {
	public function push($value);
	public function pop();

	/**
	 * @return boolean
	 */

	public function isEmpty();

	/**
	 * @return boolean
	 */

	public function isFull();
}