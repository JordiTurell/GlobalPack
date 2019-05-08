<?php

namespace Api\Models
{
	/**
	 * DescPostVenta short summary.
	 *
	 * DescPostVenta description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */
	class DescPostVenta
	{
        public $id;
        public $descripcion;

        public function __construct($id, $desc){
            $this->id = $id;
            $this->descripcion = $desc;
        }
	}
}