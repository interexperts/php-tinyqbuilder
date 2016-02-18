<?php

use \InterExperts\TinyQ\Builder;

class BuilderTest extends PHPUnit_Framework_TestCase{

	public function testCanBuild(){
		$builder = new Builder();
		$this->assertEquals(
			"startdate.g{{DATETIMESTAMP}}.azoekterm.k{{STRING}}", 
			$builder->greater("startdate", "{{DATETIMESTAMP}}")->and()->like("zoekterm", "{{STRING}}")->build()
		);

		$builder = new Builder();
		$this->assertEquals(
			"startdate.g{{DATETIMESTAMP}}.o.szoekterm.k{{STRING}}.aloglevel.e{{LOGLEVEL}}.f", 
			$builder->greater("startdate", "{{DATETIMESTAMP}}")->or()->lparen()->like("zoekterm", "{{STRING}}")->and()->equal("loglevel", "{{LOGLEVEL}}")->rparen()->build()
		);
	}

	public function testCanReset(){
		$builder = new Builder();
		$builder->greater('x', 10);
		$this->assertNotEmpty($builder->build());
		$builder->reset();
		$this->assertEmpty($builder->build());
	}

	public function testThrowOnIllegalMethod(){
		$builder = new Builder();
		$this->setExpectedException(
			'\BadMethodCallException'
		);
		$builder->illegalMethod();
	}
}