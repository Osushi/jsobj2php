<?php

namespace JsObj2Php;

function sTrim(string $string)
{
  return preg_replace('/(\s|　|\n)/', '', $string);
}

function mbTrim(string $string, string $charlist = '\\\\s', bool $ltrim = true, bool $rtrim = true)
{
  $bothEnds = $ltrim && $rtrim;

  $charClassInner = preg_replace(
    ['/[\^\-\]\\\]/S', '/\\\{4}/S'],
    ['\\\\\\0', '\\'],
    $charlist
  );

  $workHorse = '['.$charClassInner.']+';
  $ltrim && $leftPattern = '^'.$workHorse;
  $rtrim && $rightPattern = $workHorse.'$';

  if ($bothEnds) {
    $patternMiddle = $leftPattern.'|'.$rightPattern;
  } elseif ($ltrim) {
    $patternMiddle = $leftPattern;
  } else {
    $patternMiddle = $rightPattern;
  }

  return preg_replace("/$patternMiddle/usSD", '', $string);
}

function unicode_decode(string $string)
{
  return preg_replace_callback("/((?:[^\x09\x0A\x0D\x20-\x7E]{3})+)/", "\JsObj2Php\decode_callback", $string);
}

function decode_callback(array $matches)
{
  $char = mb_convert_encoding($matches[1], "UTF-16", "UTF-8");
  $escaped = "";
  for ($i = 0, $l = strlen($char); $i < $l; $i += 2) {
    $escaped .=  "\u" . sprintf("%02x%02x", ord($char[$i]), ord($char[$i+1]));
  }
  return $escaped;
}
