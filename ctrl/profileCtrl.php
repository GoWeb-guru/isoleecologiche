<?php
ob_start();

use util\User, util\URL, model\Azienda;

require_once ('commonCtrl.php');


if ($userUtils->isUserInGroup($loggedUser, "azienda")) {
	URL::redirect('aziendaCtrl.php');
}else if ($userUtils->isUserInGroup($loggedUser, "conto terzi intermediario") || $userUtils->isUserInGroup($loggedUser, "conto terzi consorzio")) {
	URL::redirect('comuneCtrl.php');
}else if ($userUtils->isUserInGroup($loggedUser, "consorzio")) {
	URL::redirect('consorzioCtrl.php');
}else if ($userUtils->isUserInGroup($loggedUser, "societa servizi")) {
	URL::redirect('societaCtrl.php');
}

ob_end_flush();