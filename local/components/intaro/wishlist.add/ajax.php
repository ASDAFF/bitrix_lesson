<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

CBitrixComponent::includeComponentClass("intaro:wishlist.add");

	if ($_POST['action'] == "add") {
	    $userId = $USER->GetID();
		$idArray = $_POST['productId'];
		$wishAdd = new WishAdd();
		$wishAdd->arParams = [
	            'ACTION' => 'ADD',
	            'PRODUCT_ID' => $_POST['productId']
	    ];
		$res = $wishAdd->addAndRefresh($userId, $productId);

		header('Content-Type: application/json');
		echo json_encode($res);
		die();
	} else if ($_POST['action'] == "refresh") {
		$userId = $USER->GetID();
		$idArray = $_POST['idArray'];
		$res = WishAdd::getAll($userId, $idArray);

		header('Content-Type: application/json');
		echo json_encode($res);
		die();
	}

