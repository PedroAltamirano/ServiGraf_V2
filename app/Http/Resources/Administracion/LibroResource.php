<?php

namespace App\Http\Resources\Administracion;

use Illuminate\Http\Resources\Json\JsonResource;

class LibroResource extends JsonResource
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
          'fecha' => $this->fecha,
          'referencia' => $this->referencia->referencia,
          'beneficiario' => $this->beneficiario,
          'detalle' => $this->detalle,
          'ingreso' => $this->ingreso,
          'egreso' => $this->egreso,
          'libro_ref_id' => $this->libro_ref_id,
          'ci' => $this->ci,
          'banco_id' => $this->banco_id,
          'cuenta' => $this->cuenta,
          'cheque' => $this->cheque,
        ];
    }
}
