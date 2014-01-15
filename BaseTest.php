<?php

require_once('Base.class.php');

class BaseTest extends PHPUnit_Framework_TestCase {

	function testBasic(){
		$base = new Base();

		$base->prop(5);
		$this->assertEquals(5, $base->prop() );
		$this->assertEquals($base->get_prop(), $base->prop());

		$base->prop('string');
		$this->assertEquals('string', $base->prop());
		$this->assertEquals($base->get_prop(), $base->prop());

		$base->another_prop(true);
		$this->assertEquals(true, $base->another_prop());
		$this->assertEquals($base->get_another_prop(), $base->another_prop());

		$this->assertEquals(null, $base->undef());

		$this->assertEquals($base->a('a')->b('b')->a(), 'a');
		$this->assertEquals($base->b(), 'b');
	}
}