<?php

require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use \InterExperts\TinyQ\Builder;

$builder = new Builder();

$builder->not()
        ->equal('name', 'henry.aaron')
        ->or()
        ->lparen()
        ->greaterOrEqual('age', 18)
        ->and()
        ->LessOrEqual('age', 65)
        ->rparen();
$query = $builder->build();