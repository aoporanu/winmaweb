<?php 
/*
$sfpath = 'lib/symfony/';
require_once($sfpath.'routing/sfRoute.class.php');
require_once($sfpath.'routing/sfRouting.class.php');
require_once($sfpath.'routing/sfPatternRouting.class.php');

require_once($sfpath.'event_dispatcher/sfEvent.php');
require_once($sfpath.'event_dispatcher/sfEventDispatcher.php');
 
$routing = new sfPatternRouting(new sfEventDispatcher());
$routing->connect('home', new sfRoute('/'));
$routing->connect('hello_world', new sfRoute('/hello/:name/:id', array(
  'action' => 'hello',
  'module' => 'main',
  'id' => 1),
  array('id' => '\d+', 'sf_method' => 'put')
  ));
$routing->connect('default', new sfRoute('/:module/:action'));
 
$ret = $routing->parse($_SERVER["REQUEST_URI"]);

print_r($ret);
/*foreach($ret as $key => $val)
{
  if (!is_object($val))
  {
  echo "{$key} :: {$val} </br >";
  }
}*/

print_R($_SERVER["REQUEST_URI"]);
?>