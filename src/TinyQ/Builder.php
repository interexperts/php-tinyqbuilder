<?php

namespace InterExperts\TinyQ;

class Builder{
	protected $queryString = '';

	protected function createEscapedString($key, $value, $operator){
		return $this->escape($key) . $operator . $this->escape($value);
	}

	public function greater($key, $value){
		$this->queryString .= $this->createEscapedString($key, $value, '.g');
		return $this;
	}

	public function greaterOrEqual($key, $value){
		$this->queryString .= $this->createEscapedString($key, $value, '.h');
		return $this;
	}

	public function less($key, $value){
		$this->queryString .= $this->createEscapedString($key, $value, '.l');
		return $this;
	}

	public function lessOrEqual($key, $value){
		$this->queryString .= $this->createEscapedString($key, $value, '.m');
		return $this;
	}

	public function notEqual($key, $value){
		$this->queryString .= $this->createEscapedString($key, $value, '.n');
		return $this;
	}

	public function not(){
		$this->queryString .= ".t";
		return $this;
	}

	public function _and(){
		$this->queryString .= ".a";
		return $this;
	}

	public function _or(){
		$this->queryString .= ".o";
		return $this;
	}

	public function like($key, $value){
		$this->queryString .= $this->createEscapedString($key, $value, '.k');
		return $this;
	}

	public function lparen(){
		$this->queryString .= ".s";
		return $this;
	}

	public function rparen(){
		$this->queryString .= ".f";
		return $this;
	}

	public function equal($key, $value){
		$this->queryString .= $this->createEscapedString($key, $value, '.e');
		return $this;
	}

	public function reset(){
		$this->queryString = '';
		return $this;
	}

	public function build(){
		return $this->queryString;
	}

	public function __call($method, $args){
		if($method == 'and'){
			return call_user_func_array(array($this,"_and"), $args);
		}elseif($method == 'or'){
			return call_user_func_array(array($this,"_or"), $args);
		}else{
			throw new \BadMethodCallException("Method {$method} doesn't exists");
		}
	}

	protected function escape($string){
		$string = str_replace('.', '..', $string);
		$string = str_replace('..-', '.-', $string);
		$string = str_replace('.._', '._', $string);
		return $string;
	}

	public function escapeLike($string){
		$string = str_replace('-', '.-', $string);
		$string = str_replace('_', '._', $string);
		return $string;
	}

}