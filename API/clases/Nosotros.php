<?php

namespace Api\Models
{
	/**
	 * Nosotros short summary.
	 *
	 * Nosotros description.
	 *
	 * @version 1.0
	 * @author Caperucitorojo
	 */
	class Nosotros
	{

        public $img;
        public $text;
        public $Beneficios;

        public function __construct($img, $text, $Beneficions){
            $this->img = $img;
            $this->text = $text;
            $this->Beneficios = $Beneficions;
        }
	}
}