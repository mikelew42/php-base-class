<?php


class Base {

	public function __call($name, $args){
		return $args ? $this->set($name, $args[0]) : $this->get($name);
	}

	public function __get($name){
		return $this->get($name);
	}

	public function __set($name, $value){
		return $this->set($name, $value);
	}

	public function __isset($name){
		return !is_null($this->get($name));
	}

	public function set($name, $value){
		// this allows set_property() to be called without actually defining set_property(){}
		if (strpos($name, 'set_') === 0)
			$name = substr($name, 4);

		// does set_{$name}() method exist?  if so, use that
		if (method_exists($this, $set_method = 'set_' . $name))
			$this->{$set_method}($value);

		// if not, just set it
		else
			$this->{$name} = $value;

		// maintain chainability
		return $this;
	}

	public function get($name){
		// this allows get_property() to be called without actually defining get_property(){}
		if (strpos($name, 'get_') === 0)
			$name = substr($name, 4);

		return method_exists($this, $get_method = 'get_' . $name) ? $this->{$get_method}() :
			( property_exists($this, $name) ? $this->{$name} : null );
	}
}