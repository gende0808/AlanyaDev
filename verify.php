<?php
include_once 'interfaces/CRUD.php';
include_once "connection.php";
require_once 'classes/Account.php';

if(empty($_GET['id']) || empty($_GET['code']))
{
//redirect hier naar index.php
}

if(isset($_GET['id']) && isset($_GET['code'])) {
	$id = $_GET['id'];
	$code = $_GET['code'];

	$statusY = "Y";
	$statusN = "N";

	$account = new Account($DB_con, $id);

	if($account->getToken() === $code) {
	$account->setstatus("Y");
		$account->update($id);

	}

}