<?php

namespace Api\Models
{
	/**
	 * Usuario short summary.
	 *
	 * Usuario description.
	 *
	 * @version 1.0
	 * @author Jordi Turell Nebot
	 */

	class Usuario
	{
        public $Indice;
        public $ID;
        public $Login;
        public $FechaC;
        public $Info;


        function __construct($Indice, $ID, $Login, $FechaC, $Info){
            $this->Indice = $Indice;
            $this->ID = $ID;
            $this->Login = $Login;
            $this->FechaC = $FechaC;
            $this->Info = $Info;
        }
	}
}