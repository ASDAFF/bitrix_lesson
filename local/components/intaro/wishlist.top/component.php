<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    CModule::IncludeModule("highloadblock"); 

    use Bitrix\Highloadblock as HL; 
    use Bitrix\Main\Entity; 

    $hlbl = $arParams['WISHLIST_HL_ID'];
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

    $entity = HL\HighloadBlockTable::compileEntity($hlblock); 
    $strEntityDataClass = $entity->getDataClass(); 

    if (CModule::IncludeModule('highloadblock'))
    {
        $hlData = $strEntityDataClass::getList(array(
            "select" => array("UF_PRODUCT_ID"),
            "filter" => array(),
            "order" => array('CNT' => "DESC", "UF_PRODUCT_ID" => "ASC"),
            "limit" => $arParams['WISHLIST_TOP_LIMIT'],
            'runtime' => array(
                new Entity\ExpressionField('CNT', 'COUNT(*)')
            )
        ));

        while ($hlItem = $hlData->Fetch()) {
            $arSelect = array();
            $arFilter = array("IBLOCK_ID" => $arParams['CATALOG_IBLOCK_ID'], "ID" => $hlItem['UF_PRODUCT_ID'], "ACTIVE" => "Y");
            $arElement = CIBlockElement::GetList(array(), $arFilter, false, [], $arSelect)->GetNext();
            array_push($arResult, $arElement);
        }
    }

    $this->IncludeComponentTemplate();
?>