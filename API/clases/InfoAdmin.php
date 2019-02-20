<?php

namespace Api\Models
{
	/**
	 * InfoAdmin short summary.
	 *
	 * InfoAdmin description.
	 *
	 * @version 1.0
	 * @author Jordi Turell Nebot
	 */
	class InfoAdmin
	{
        public $nombre;
        public $apellidos;
        public $telefono;

        function __construct($nombre, $apellidos, $telefono){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->telefono = $telefono;
        }
	}
}