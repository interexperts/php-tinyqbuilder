<?php

use \InterExperts\TinyQ\Builder;

class BuilderTest extends PHPUnit_Framework_TestCase{

	public function testCanBuild(){
		$builder = new Builder();
		$this->assertEquals(
			"startdate.g{{DATETIMESTAMP}}.azoekterm.k{{STRING}}", 
			$builder->greater("startdate", "{{DATETIMESTAMP}}")->and()->like("zoekterm", "{{STRING}}")->output()
		);

		$builder = new Builder();
		$this->assertEquals(
			"startdate.g{{DATETIMESTAMP}}.o.szoekterm.k{{STRING}}.aloglevel.e{{LOGLEVEL}}.f", 
			$builder->greater("startdate", "{{DATETIMESTAMP}}")->or()->lparen()->like("zoekterm", "{{STRING}}")->and()->equal("loglevel", "{{LOGLEVEL}}")->rparen()->output()
		);
	}

	public function testThrowOnIllegalMethod(){
		$builder = new Builder();
		$this->setExpectedException(
			'\BadMethodCallException'
		);
		$builder->illegalMethod();
	}
}