<?php

use \JsObj2Php\Converter;

class ConverterTest extends \PHPUnit\Framework\TestCase
{
  public function testFixtures()
  {
    $fixtures = [
      '{fu:"bar",baz:["bat"]}',
      '{rec:{rec:{rec:false}}}',
      '{foo:[1,2,[3,4]]}',
      '{fu:{fu:"bar"},bar:{fu:"bar"}}',
      '{"quoted key":[1,2,3]}',
      '{und:undefined,"baz":[1,2,"3"]}',
      '{arr:["a","b"],"baz":"foo","gar":{"faz":false,t:"2"},f:false}',
      '{name:"Andrew", age: "11", toys: { car: [{color:"red", wheel: "1"} ,{color:"white", wheel: "4"}]}, bus: [ {av: "Mug 2013", var: [ {color:"red", wheel: "10"} ,{color:"white", wheel: "34"}], totl: 10,buy: true}]}',
      '{baseprice:3300,items:[{id:1,price:1000,commnet:"foo",memo:[]},{id:2,price:2000,memo:[]}],counts:[10, 20],message:"ほげ",pickup:{id:1,price:1000,commnet:"foo",memo:[0, 1, 2]}}',
      '{items:[{id:1,price:1000,commnet:"foo",memo:[]},{id:2,price:2000,memo:[]},],}',
      "{items:'test'}",
      "{items: '2012-11-05'}",
    ];

    foreach ($fixtures as $fixture) {
      $this->assertEquals(true, is_array(Converter::execute($fixture, true)));
    }
  }

  public function testInvalidString()
  {
    try {
      Converter::execute('', true);
      $this->fail('Unable to occur error exception');
    } catch (\Exception $e) {
      $this->assertEquals('The given string is null', $e->getMessage());
    }
  }

  public function testInvalidObject()
  {
    try {
      Converter::execute('[]', true);
      $this->fail('Unable to occur error exception');
    } catch (\Exception $e) {
      $this->assertEquals('The given string is not a Javascript object', $e->getMessage());
    }
  }
}
