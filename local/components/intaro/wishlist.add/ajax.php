<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
    if ($USER->IsAuthorized()) 
    {
        $userId = $USER->GetID();
        $productId = $_POST['productId'];

        CModule::IncludeModule("highloadblock"); 

        use Bitrix\Highloadblock as HL; 
        use Bitrix\Main\Entity; 

        $hlbl = 3;
        $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 
        // get entity 
        $entity = HL\HighloadBlockTable::compileEntity($hlblock); 
        $strEntityDataClass = $entity->getDataClass(); 

        $hlData = array(
            "UF_USER_ID"=>'$userId',
            "UF_PRODUCT_ID"=>'$productId',
        );

        $result = $strEntityDataClass::add($hlData);
    }
 ?>