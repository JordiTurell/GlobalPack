<?php

namespace Api\Models
{
	/**
	 * Subcategoria short summary.
	 *
	 * Subcategoria description.
	 *
	 * @version 1.0
	 * @author Caperucitorojo
	 */

    require(dirname(__FILE__).'/'.'Categoria.php');

	class Subcategoria extends Categoria
	{
        public $Id_Subcategoria;
        public $asign = false;

        function __construct($Id_Subcategoria, $Id_Categoria, $Categoria, $Descripcion, $Icono, $Activada){
            $this->Activada = $Activada;
            $this->Categoria = $Categoria;
            $this->Descripcion = $Descripcion;
            $this->Icono = $Icono;
            $this->Id_Categoria = $Id_Categoria;
            $this->Id_Subcategoria = $Id_Subcategoria;
        }

        public function SetAsign($asign){
            $this->asign = $asign;
        }
	}
}