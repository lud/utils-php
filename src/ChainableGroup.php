<?php namespace Lud\Utils;

/**
 * This class takes an array of objects. When one invokes a method from
 * the class instance, all the objects in the array have the same method
 * invoked, with same parameters. Then the array of objects is set to what
 * the invocations returns from each object, thus allowing chaining.
 * It is intended to work with objects that provide chaining methods
 */
class ChainableGroup {

	private $objects;

	public function __construct($objects) {
		$this->objects = $objects;
	}

	public function __call($method, $args) {
		$fun = function($object) use ($method, $args) {
			return call_user_func_array([$object,$method], $args);
		};
		$this->objects = array_map($fun, $this->objects);
		return $this;
	}

}
