<?php

namespace Api\Models
{
	/**
	 * Categoria short summary.
	 *
	 * Categoria description.
	 *
	 * @version 1.0
	 * @author Caperucitorojo
	 */
	class Categoria
	{
        public $Id_Categoria;
        public $Categoria;
        public $Descripcion;
        public $Icono;
        public $Activada;

        function __construct($Id_Categoria, $Categoria, $Descripcion, $Icono, $Activada){
            $this->Id_Categoria = $Id_Categoria;
            $this->Categoria = $Categoria;
            $this->Descripcion = $Descripcion;
            $this->Icono = $Icono;
            $this->Activada = $Activada;
        }
	}
}