<?php

namespace JsObj2Php;

use function JsObj2Php\mbTrim;
use function JsObj2Php\sTrim;
use function JsObj2Php\unicode_decode;

class Converter
{
  public static function execute(string $str, bool $isArray = false)
  {
    $str = sTrim(mbTrim($str));
    self::validate($str);
    $str = preg_replace('/([a-zA-Z0-9\_]+):/', '"$1":', $str);
    $str = preg_replace('/\"[a-zA-Z0-9\_]+\":undefined,/', '', $str);
    $str = str_replace([',]', ',}'], [']', '}'], $str);

    return json_decode(unicode_decode($str), $isArray);
  }

  private static function validate(string $str)
  {
    if (mb_strlen($str) < 1) {
      throw new \Exception('The given string is null');
    }
    if ($str{0} != '{' || mb_substr($str, -1) != '}') {
      throw new \Exception('The given string is not a Javascript object');
    }
  }
}
