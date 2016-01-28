<?php
class AppHelper extends Helper {
	function __construct() {
		parent::__construct();
		$this->loadConfig( );
	}

	public function url($url = null, $full = false) {
		return parent::url(router_url_language($url), $full);
	}
}
?>