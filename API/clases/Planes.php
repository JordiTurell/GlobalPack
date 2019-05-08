<?php

namespace Api\Models
{
	/**
	 * Planes short summary.
	 *
	 * Planes description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */
	class Planes
	{
        public $Indice;
        public $Id_Plan;
        public $Titulo;
        public $Descripcion;
        public $Orden;
        public $FechaC;
        public $Habilitado;
        public $color;

        public function __construct($Indice, $Id_Plan, $Titulo, $Descripcion, $Orden, $FechaC, $Habilitado){
            $this->Indice = $Indice;
            $this->Id_Plan = $Id_Plan;
            $this->Titulo = $Titulo;
            $this->Descripcion = $Descripcion;
            $this->Orden = $Orden;
            $this->FechaC = $FechaC;
            $this->Habilitado = $Habilitado;
        }

        public function SetColor($c){
            $this->color = $c;
        }
	}
}