<?php

namespace Api\Models
{
	/**
	 * Servicios short summary.
	 *
	 * Servicios description.
	 *
	 * @version 1.0
	 * @author Caperucitorojo
	 */
	class Servicios
	{
        public $Id_Servicios;
        public $Nombre;
        public $Icono;
        public $Activada;

        function __construct($Id_Servicios, $Nombre, $Icono, $Activada){
            $this->Id_Servicios = $Id_Servicios;
            $this->Nombre = $Nombre;
            $this->Icono = $Icono;
            $this->Activada = $Activada;
        }
	}
}