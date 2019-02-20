<?php

namespace Api\Models
{
	/**
	 * Nosotros_Cabecera short summary.
	 *
	 * Nosotros_Cabecera description.
	 *
	 * @version 1.0
	 * @author Caperucitorojo
	 */
	class Nosotros_Cabecera
	{
        public $imagen;
        public $texto;

        public function __construct($img, $text){
            $this->imagen = $img;
            $this->texto = $text;
        }
	}
}