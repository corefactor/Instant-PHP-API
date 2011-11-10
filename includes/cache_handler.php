<?php

Class CacheHandler {
	
	private $__cache_folder = null;
	
	private $__conf = array('duration' => '5 minutes');
	
	
	public function constructor($cache_folder, $conf = null) {
		
		$this->__cache_folder = $cache_folder;
		
		$this->__conf = array_merge($this->__conf, $conf);
		
	}
	
	private function __getFileName($name) {
		
		return $this->__cache_folder . $name;
		
	}
	
	
	public function get($name) {
		
		if (!file_exists($this->__getFileName($name))) {
			return false;
		}
		
		
		
	}
	
	public function set($name, $content, $conf = null) {
		
		$tmp_file_content = array(
			'created' => time(),
			'content' => $content
		);
		
		$tmp_file_content = array_merge($tmp_file_content, $this->__conf);
		
		#var_dump($tmp_file_content);

		if (file_put_contents(CACHE_FOLDER . '/' . $name, serialize($tmp_file_content)) !== false) {
			return true;
		}
		
		return false;
		
	}
	
	
}

?>