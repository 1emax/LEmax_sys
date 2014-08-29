<?php

class DebugObject {
	private $debug = false;
	private static $instance = null;

	// true or false
	public function __construct() {
		$this->debug = DEBUG;
	}

	/**
	 * Возвращает экземпляр конфигурации
	 * return mainConfiguration
	 */
	public static function getInstance() {
		if(!self::$instance) {
			self::$instance = new DebugObject();
		}
		return self::$instance;
	}
}
?>