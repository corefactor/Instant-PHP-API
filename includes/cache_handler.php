<?php

Class CacheHandler {
	
	private $__cache_folder = null;
	
	
	public function constructor($cache_folder) {
		
		$this->__cache_folder = $cache_folder;
		
	}
	
	public function get() {
		
		
		
	}
	
	public function set($content) {
		
		$content = serialize($content);
		$file_name = md5($content);
		
	}
	
	
}

?>