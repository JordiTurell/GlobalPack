<?php

namespace Api\Models
{
	/**
	 * Administrador short summary.
	 *
	 * Administrador description.
	 *
	 * @version 1.0
	 * @author Jordi Turell Nebot
	 */
    
	class Administrador
	{
        public $Indice;
        public $ID;
        public $Login;
        public $FechaC;
        public $Info;
        public $admin = true;
        public $status = false;


        function __construct($Indice, $ID, $Login, $FechaC, $Info, $status){
            $this->Indice = $Indice;
            $this->ID = $ID;
            $this->Login = $Login;
            $this->FechaC = $FechaC;
            $this->Info = $Info;
            $this->status = $status;
        }
	}
}