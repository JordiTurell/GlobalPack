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

        function __construct($id, $url){
            $this->id = $id;
            $this->url = $url;
        }
	}
}