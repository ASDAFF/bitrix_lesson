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
            if ($strEntityDataClass::getList(array("select" => array("*"), "filter" => array('UF_USER_ID' => $userId, "ID" => $arParams['WISH_ID'])))->Fetch()) {
                $result = $strEntityDataClass::delete($arParams['WISH_ID']);
            }
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

        $hlItems = [];
        while ($hlItem = $hlData->Fetch()) {
            $hlItems[$hlItem['ID']] = $hlItem['UF_PRODUCT_ID'];
        }

        if (!empty($hlItems)) {
            $productIdToId = array_flip($hlItems);
            $arSelect = array();
            $arFilter = array("IBLOCK_ID" => $arParams['CATALOG_IBLOCK_ID'], "ID" => $hlItems, "ACTIVE" => "Y");
            $dbElements = CIBlockElement::GetList([], $arFilter, false, [], $arSelect);
            while ($arElement = $dbElements->Fetch()) {
                $iBlockItem = $arElement;
                $iBlockItem['HL_ITEM_ID'] = $productIdToId[$arElement['ID']];
                $arResult['ITEMS'][] = $iBlockItem;
            }
        }
    }

    $this->IncludeComponentTemplate();