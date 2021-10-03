<?php

function output($value) {
	return htmlspecialchars($value, ENT_QUOTES | ENT_HTML401);
}

function outputJS($value) {
	return addslashes(htmlspecialchars($value));
}

function getSelectedOption($field, $value, $default = '') {
	return (isset($_POST[$field]) ? $_POST[$field] : $default) === strval($value) ? 'selected="selected"' : '';
}

function getUpdateSelectedOption($field, $value) {
	return isset($field) && $field == $value ? 'selected="selected"' : '';
}

function getInputValue($field, $default = '') {
	return isset($_POST[$field]) ? output($_POST[$field]) : $default;
}

function parseDecimal($field) {
	return floatval(str_replace(',', '.', $field));
}

//bruno
function esiste($field, $default = null) {
	return isset($field) ? output($field) : $default;
}

function parseFile($fileToInclude, $argumentsToFile=false) {
   
    /*if (!file_exists($fileToInclude)) {
        return '';
	}*/
	
    if ($argumentsToFile === false) {
        $argumentsToFile = Array();
	}
	
    foreach ($argumentsToFile as $variableName => $variableValue) {
        $$variableName = $variableValue;
	}
	
	ob_start();
	include($fileToInclude);
	$ret = ob_get_contents();
	ob_end_clean();
	   
    return $ret;
}

function getRequestedFile() {
	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	return substr(strrchr($path , '/'), 1);
}

function isPageEnabled($loggedUser, $pageName, $permissionMappings) {
	
	if (isset($permissionMappings[$pageName])) {
		if (!$loggedUser->hasAccess($permissionMappings[$pageName])) {
			return false;
		}
	}
	
	return true;
}

