<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity; 

    $APPLICATION->IncludeComponent('intaro:wishlist', '', [
            'ACTION' => 'ADD', 
            'PRODUCT_ID' => $_POST['productId'],
            "DISPLAY_BOTTOM_PAGER" => "Y",
			"WISHLIST_HL_ID" => 3,
			"NAV_PAGE_SIZE" => 5,
			"CATALOG_IBLOCK_ID" => 2
    ]);
?>

