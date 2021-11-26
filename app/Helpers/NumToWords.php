<?php

namespace App\Helpers;

use NumberFormatter;

class NumToWords
{
  public function numtowords(float $num)
  {
    $decimal = (int)explode('.', number_format(fmod($num, 1), 2))[1];
    $entero = (int)$num;
    if (!$entero) {
      return false;
    }

    $word = '';

    $formatter = new NumberFormatter("es", NumberFormatter::SPELLOUT);
    $entero = $formatter->format($entero);
    $decimal = $formatter->format($decimal);

    $word .= $entero . ' dólares';
    $word .= ' con ' . $decimal . ' centavos';

    return $word;
  }
}
