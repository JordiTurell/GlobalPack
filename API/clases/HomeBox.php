<?php

namespace Api\Models
{
	/**
	 * HomeBox short summary.
	 *
	 * HomeBox description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */
	class HomeBox
	{
        public $imagen;
        public $nombre;
        public $url;

        public function __construct($img, $nom, $url){
            $this->imagen = $img;
            $this->nombre = $nom;
            $this->url = $url;
        }
	}
}