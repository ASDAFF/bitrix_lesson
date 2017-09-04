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
        $userId = $USER->GetID();

        $nav = new \Bitrix\Main\UI\PageNavigation("nav-more-notice");
        $nav->allowAllRecords(true)
            ->setPageSize($arParams['NAV_PAGE_SIZE'])
            ->initFromUri();

        $hlData = $strEntityDataClass::getList(array(
            "select" => array("*"),
            "order" => array(),
            "count_total" => true, 
            "offset" => $nav->getOffset(), 
            "limit" => $nav->getLimit(), 
            "filter" => array('UF_USER_ID' => $userId)
        ));

        $hlCount = $hlData->getCount();

        while ($hlItem = $hlData->Fetch()) {
            $arSelect = array();
            $arFilter = array("IBLOCK_ID" => $arParams['CATALOG_IBLOCK_ID'], "ID" => $hlItem['UF_PRODUCT_ID'], "ACTIVE" => "Y");
            $arElement = CIBlockElement::GetList(array(), $arFilter, false, [], $arSelect)->Fetch();

            $arElement['HL_BLOCK_ID'] = $hlItem['ID'];
            array_push($arResult, $arElement);
            
        }

        $nav->setRecordCount(10);

        if ($arParams['ACTION'] == 'REMOVE') {
            $hlFilter = array(
                "UF_USER_ID"=>$userId,
                "UF_PRODUCT_ID"=>$arParams['WISH_ID']
            );

            $hlData = $strEntityDataClass::getList(array(
               "select" => array("*"),
               "order" => array(),
               "filter" => $hlFilter
            ));

            if ($arItem = $hlData->fetch()) {
                $idForDel = $arItem['ID'];
                $result = $strEntityDataClass::delete($idForDel);
            }
        }
    }
    $this->IncludeComponentTemplate();

    $APPLICATION->IncludeComponent("bitrix:main.pagenavigation", "", Array(
        "NAV_OBJECT" => $nav,
            "SEF_MODE" => "N"
        ),
        false
    );
?>