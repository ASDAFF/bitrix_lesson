<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity; 

    if ($USER->IsAuthorized()) 
    {
        $userId = $USER->GetID();
        $productId = $_POST['productId'];

        CModule::IncludeModule("highloadblock"); 

        

        $hlbl = 3;
        $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 
        // get entity 
        $entity = HL\HighloadBlockTable::compileEntity($hlblock); 
        $strEntityDataClass = $entity->getDataClass(); 

        $hlData = array(
            "UF_USER_ID"=>$userId,
            "UF_PRODUCT_ID"=>$productId,
        );
        var_dump($hlData);
        $result = $strEntityDataClass::add($hlData);
    }
 ?>