<?php

namespace App\Helpers;

class Functions
{
  public static $colors = ['success', 'primary', 'danger'];
  public static $percentage = 0.2;

  public static function getColor($actual, $need)
  {
    $range = $need - ($need * self::$percentage);
    if ($actual < $range) {
      return self::$colors[2];
    }
    if ($actual > $need) {
      return self::$colors[0];
    }
    return self::$colors[1];
  }
}
