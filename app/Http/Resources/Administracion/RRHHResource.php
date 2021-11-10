<?php

namespace App\Http\Resources\Administracion;

use Illuminate\Http\Resources\Json\JsonResource;

class RRHHResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'nombre' => $this->nomina->fullName,
      'fecha' => $this->fecha,
      'entrada_1' => $this->llegada_mañana,
      'salida_1' => $this->salida_mañana,
      'entrada_2' => $this->llegada_tarde,
      'salida_2' => $this->salida_tarde,
      'total' => $this->total,
      'extras' => $this->extras
    ];
  }
}
