<?php

class ApiResponse {
	
	private $__reponse_type = 'JSON';
	
	private $__response_object = null;
	
	public function __construct($response_type = 'JSON') {
		
		$this->__response_type = $response_type;
		
	}
	
	public function set($status = 200, $response_obj = null) {
		
		$this->__response_object = array(
			'Status' => $status,
			'Results' => $response_obj
		);
		
	}
	
	public function get($callback = null) {
		
		if ($this->__response_type == 'JSON') {
				
			if (!is_null($callback)) {	
				
				return $callback . '(' . json_encode($this->__response_object) . ' ) ';
				
			} else {
				
				return json_encode($this->__response_object);
				
			}
			
		}
		
	}
	
}

?>