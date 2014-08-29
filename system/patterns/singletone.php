<?php
/**
	* Базовый класс синглетон
*/
	abstract class singleton {
		private static $instances = Array();

		/**
			* Конструктор, который необходимо перегрузить в дочернем классе
		*/
		abstract protected function __construct();

		/**
			* Получить экземпляр класса, необходимо перегрузить в дочернем классе:
			* parent::getInstance(__CLASS__)
			* @param String имя класса
			* @return singleton экземпляр класса
		*/
		public static function getInstance($c = NULL) {
			if (!isset(singleton::$instances[$c])) {
				singleton::$instances[$c] = new $c;
			}
			return singleton::$instances[$c];
		}

		/**
			* Запрещаем копирование
		*/
		public function __clone() {
			throw new coreException('Singletone clonning is not permitted.');
		}

		/**
		 * @static
		 * Выставляет экземпляр для синглтона
		 * Использовать только для написания unit-тестов
		 * @param $instance экземпляр
		 * @param string|null $className имя класса-синглтона
		 * @return singleton
		 * @throws coreException
		 */
		public static function setInstance($instance, $className = NULL) {
			if (is_null($className)) {
				throw new coreException('Unknown class name for set instance.');
			}
			return singleton::$instances[$className] = $instance;
		}
		
		/**
			* Отключить кеширование повторных sql-запросов
		*/
		protected function disableCache() {
			if(!defined('MYSQL_DISABLE_CACHE')) {
				define('MYSQL_DISABLE_CACHE', '1');
			}
		}

		/**
			* Получить языкозависимую строку по ее ключу
			* @param String $label ключ строки
			* @return String значение строки в текущей языковой версии
		*/
		protected function translateLabel($label) {
			$prefix = "i18n::";
			$str = null;
			if(substr($label, 0, strlen($prefix)) == $prefix) {
				// $str = getLabel(substr($label, strlen($prefix)));
			} else {
				// $str = getLabel($label);
			}
			return (is_null($str)) ? $label : $str;
		}

	};
?>