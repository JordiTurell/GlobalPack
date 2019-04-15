<?php

namespace Api\Models
{
	/**
	 * HomeText short summary.
	 *
	 * HomeText description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */
	class HomeText
	{
        public $titulo;
        public $desc;

        public function __construct($title, $desc){
            $this->titulo = $title;
            $this->desc = $desc;
        }
	}
}