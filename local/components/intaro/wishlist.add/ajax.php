<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity; 

    $APPLICATION->IncludeComponent('intaro:wishlist.add', '', [
            'ACTION' => 'ADD', 
            'PRODUCT_ID' => $_POST['productId']
    ]);
?>

