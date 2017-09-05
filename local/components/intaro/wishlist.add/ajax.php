<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity; 

	if ($_POST['action'] == "add") {
	    $APPLICATION->IncludeComponent('intaro:wishlist.add', '', [
	            'ACTION' => 'ADD', 
	            'PRODUCT_ID' => $_POST['productId']
	    ]);
	} else if ($_POST['action'] == "refresh") {
		$APPLICATION->IncludeComponent('intaro:wishlist.add', '', [
	            'PRODUCT_ID' => $_POST['productId']
	    ]);
	}
?>

