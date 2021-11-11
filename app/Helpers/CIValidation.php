<?php

namespace App\Helpers;

class CIValidation
{
  private function modulo_10($ci, $ci_len, $coef)
  {
    $ci_array  = array_map('intval', str_split($ci));
    array_splice($ci_array, $ci_len);
    $last = array_pop($ci_array);
    $coef_sum = 0;
    foreach ($ci_array as $key => $val) {
      $res = $val * $coef[$key];
      if ($res >= 10) {
        $res -= 9;
      }
      $coef_sum += $res;
    }
    $nearest_ten = (int) ceil($coef_sum / 10) * 10;
    $res = $nearest_ten - $coef_sum;
    if ($res == 10) {
      $res = 0;
    }

    return ($res == $last);
  }

  private function modulo_11($ci, $ci_len, $coef)
  {
    $ci_array  = array_map('intval', str_split($ci));
    array_splice($ci_array, $ci_len);
    $last = array_pop($ci_array);
    $coef_sum = 0;
    foreach ($ci_array as $key => $val) {
      $coef_sum += $val * $coef[$key];
    }
    $diff = floor($coef_sum / 11);
    $residuo = $coef_sum % 11;
    $res = 11 - $residuo;

    return ($res == $last);
  }

  public function validate(int $ci): bool
  {
    $regex = "/^(\d{2})(\d)(\d{5,6})(\d)(00[1-9])?$/";
    $match = preg_match_all($regex, (string) $ci, $matches);
    if (!$match) {
      return false;
    }

    $third = (int) $matches[2][0];
    switch ($third) {
      case 0:
      case 1:
      case 2:
      case 3:
      case 4:
      case 5:
        $ci_len = 10;
        $coef = [2, 1, 2, 1, 2, 1, 2, 1, 2];
        return $this->modulo_10($ci, $ci_len, $coef);
      case 6:
        $ci_len = 9;
        $coef = [3, 2, 7, 6, 5, 4, 3, 2];
        return $this->modulo_11($ci, $ci_len, $coef);
      case 9:
        $ci_len = 10;
        $coef = [4, 3, 2, 7, 6, 5, 4, 3, 2];
        return $this->modulo_11($ci, $ci_len, $coef);
      default:
        return false;
    }
  }
}

var_dump((new CIValidation)->validate(1719953282));
var_dump((new CIValidation)->validate(1719953281));
var_dump((new CIValidation)->validate(1709636664001));
var_dump((new CIValidation)->validate(1790727203001));
var_dump((new CIValidation)->validate(176815353001));
// var_dump((new CIValidation)->validate());
