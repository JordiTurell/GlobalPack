<?php

namespace Api\Models
{
	/**
	 * Multimedia short summary.
	 *
	 * ServiceListResult description.
	 *
	 * @version 1.0
	 * @author Jordi Turell Nebot
	 */

	class Multimedia
	{
        public $id;
        public $url;
        public $nombre;

        function __construct($id, $url){
            $this->id = $id;
            $this->url = $url;
        }

        public function SetNombre($nom){
            $this->nombre = $nom;
        }
	}
}