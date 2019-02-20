<?php

namespace Api\Models
{
	/**
	 * ServiceListResult short summary.
	 *
	 * ServiceListResult description.
	 *
	 * @version 1.0
	 * @author Jordi Turell Nebot
	 */
	class ServiceListResult
	{
        public $status;
        public $msg;
        public $items;
        public $pagina;
        public $total;
        public $list;

        public function __construct($status, $msg, $items, $pagina, $total){
            $this->status = $status;
            $this->msg = $msg;
            $this->items = $items;
            $this->pagina = $pagina;
            $this->total = $total;
            $this->list = [];
        }

        public function SetStatus($status){
            $this->status = $status;
        }

        public function SetMsg($msg){
            $this->msg = $msg;
        }
	}
}