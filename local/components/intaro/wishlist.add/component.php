<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    CModule::IncludeModule("highloadblock"); 

    use Bitrix\Highloadblock as HL; 
    use Bitrix\Main\Entity; 

    $hlbl = 3;
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 
    // get entity 
    $entity = HL\HighloadBlockTable::compileEntity($hlblock); 
    $strEntityDataClass = $entity->getDataClass(); 

    //$arResult['HL'] = $arItems[0]['UF_USER_ID'];
    //$arResult['DATE'] = date('Y-m-d');
    var_dump($arParams['PRODUCT_ID']);
    $this->IncludeComponentTemplate();
?>