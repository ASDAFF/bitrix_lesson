<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

	if ($_POST['action'] == "add") {
	    $APPLICATION->IncludeComponent('intaro:wishlist.add', '', [
	            'ACTION' => 'ADD',
	            'PRODUCT_ID' => $_POST['productId']
	    ]);
	} else if ($_POST['action'] == "refresh") {
		CBitrixComponent::includeComponentClass("intaro:wishlist.add");
		
		$userId = $USER->GetID();
		$idArray = $_POST['idArray'];
		$res = WishAdd::getAll($userId, $idArray);

		header('Content-Type: application/json');
		echo json_encode($res);
		die();
	}

