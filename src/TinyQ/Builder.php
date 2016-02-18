<?php

namespace InterExperts\TinyQ;

class Builder{
	protected $queryString = '';

	public function greater($key, $value){
		$this->queryString .= "{$key}.g{$value}";
		return $this;
	}

	public function greaterOrEqual($key, $value){
		$this->queryString .= "{$key}.h{$value}";
		return $this;
	}

	public function less($key, $value){
		$this->queryString .= "{$key}.l{$value}";
		return $this;
	}

	public function lessOrEqual($key, $value){
		$this->queryString .= "{$key}.m{$value}";
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
		$this->queryString .= "{$key}.k{$value}";
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
		$this->queryString .= "{$key}.e{$value}";
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
}