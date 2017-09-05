<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

    $APPLICATION->IncludeComponent('intaro:wishlist', '', [
            'ACTION' => 'REMOVE', 
            'WISH_ID' => $_POST['wishId'],
            "DISPLAY_BOTTOM_PAGER" => "Y",
			"WISHLIST_HL_ID" => 3,
			"NAV_PAGE_SIZE" => 5,
			"CATALOG_IBLOCK_ID" => 2,
    ]);

    
?>

