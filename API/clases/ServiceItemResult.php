<?php

namespace Api\Models
{
	/**
	 * ServiceItemResult short summary.
	 *
	 * ServiceItemResult description.
	 *
	 * @version 1.0
	 * @author Jordi Turell Nebot
	 */
	class ServiceItemResult
	{
        public $status;
        public $msg;
        public $item;

        public function __construct($status, $msg, $item){
            $this->status = $status;
            $this->msg = $msg;
            $this->item = $item;
        }

        public function SetStatus($var){
            $this->status = $var;
        }

        public function SetMsg($message){
            $this->msg = $message;
        }
	}
}