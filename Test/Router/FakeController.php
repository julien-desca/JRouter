<?php
namespace Test\Routeur;

class FakeController {
  public function index(){
    return 42;
  }

  public function indexWithParam(int $i){
    return ++$i;
  }

  public function indexWithParams(int $i, int $j){
    return $i+$j;
  }
}
