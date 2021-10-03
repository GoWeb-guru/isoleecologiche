<?php
namespace exception;

use \Exception;

class DBException extends Exception {
	
	//Il costruttore effettua la connessione al db 
	public function __construct($message) {
		parent::__construct($message);
    }
	
}