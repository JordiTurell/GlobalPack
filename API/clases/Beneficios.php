<?php

namespace Api\Models
{
	/**
	 * Beneficios short summary.
	 *
	 * Beneficios description.
	 *
	 * @version 1.0
	 * @author Caperucitorojo
	 */
	class Beneficios
	{
        public $icon;
        public $text;
        public $orden;
        public $id;

        public function __construct($icon, $text, $orden, $id){
            $this->icon = $icon;
            $this->text = $text;
            $this->orden = $orden;
            $this->id = $id;
        }
	}
}