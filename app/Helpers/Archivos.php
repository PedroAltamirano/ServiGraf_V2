<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class Archivos
{
  /**
   * @param string $nombre
   * @param File $archivo
   * @param string $disk
   * @return string
   */
  public static function storeImagen($nombre, $archivo, $disk)
  {
    $nombreArchivo = strtotime("now") . '_';
    $nombreArchivo .= str_replace(" ", "_", $nombre) . '.';
    $nombreArchivo .= $archivo->getClientOriginalExtension();

    Storage::disk($disk)->put($nombreArchivo, file_get_contents($archivo->getRealPath()));
    return $nombreArchivo;
  }
}
