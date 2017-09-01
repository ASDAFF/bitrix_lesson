<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    CModule::IncludeModule("highloadblock"); 

    use Bitrix\Highloadblock as HL; 
    use Bitrix\Main\Entity; 

    if ($USER->IsAuthorized()) 
    {
        $userId = $USER->GetID();

        $hlbl = 3;
        $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 
        
        $entity = HL\HighloadBlockTable::compileEntity($hlblock); 
        $strEntityDataClass = $entity->getDataClass(); 

        $hlFilter = array(
            "UF_USER_ID"=>$userId,
            "UF_PRODUCT_ID"=>$arParams['PRODUCT_ID']
        );

        $hlData = $strEntityDataClass::getList(array(
               "select" => array("*"),
               "order" => array(),
               "filter" => $hlFilter
            ));

        if ($hlData->fetch())
        {
            $arResult['WISHLESS_ITEM'] = false;
        } else {
            $arResult['WISHLESS_ITEM'] = true;
        }

        if ($arParams['ACTION'] == 'ADD') {
            if ($arResult['WISHLESS_ITEM']) {
                $idForDel = $arItem['ID'];
                $result = $strEntityDataClass::delete($idForDel);
            } else {
                $result = $strEntityDataClass::add($hlFilter);
            }
        }
    }
    $this->IncludeComponentTemplate();
?>