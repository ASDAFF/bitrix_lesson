<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    CModule::IncludeModule("highloadblock");
    CModule::IncludeModule("iblock");

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

        if ($arParams['ACTION'] == 'REMOVE') {
            $result = $strEntityDataClass::delete($arParams['WISH_ID']);
        }

        $hlData = $strEntityDataClass::getList(array(
            "select" => array("*"),
            "order" => array(),
            "count_total" => true,
            "offset" => $nav->getOffset(),
            "limit" => $nav->getLimit(),
            "filter" => array('UF_USER_ID' => $userId)
        ));

        $hlCount = $hlData->getCount();
        $arResult['NAV_RESULT'] = $hlCount;

        while ($hlItem = $hlData->Fetch()) {
            $hlItemsId[] = $hlItem['ID'];
        }

        $arSelect = array();
        $arFilter = array("IBLOCK_ID" => $arParams['CATALOG_IBLOCK_ID'], "ID" => $hlItem['UF_PRODUCT_ID'], "ACTIVE" => "Y");
        $arElement = CIBlockElement::GetList(array(), $arFilter, false, [], $arSelect)->GetNext();

        $arElement['HL_BLOCK_ID'] = $hlItem['ID'];
        $arResult['ITEMS'][] = $arElement;
    }

    $this->IncludeComponentTemplate();
?>