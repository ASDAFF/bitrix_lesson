<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    CModule::IncludeModule("highloadblock");
    CModule::IncludeModule("iblock");

    use Bitrix\Highloadblock as HL;
    use Bitrix\Main\Entity;

    $hlbl = 3;
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $strEntityDataClass = $entity->getDataClass();

    if ($USER->IsAuthorized()) {
        $userId = $USER->GetID();

        $hlFilter = array(
            "UF_USER_ID"=>$userId,
            "UF_PRODUCT_ID"=>$arParams['PRODUCT_ID']
        );

        $hlData = $strEntityDataClass::getList(array(
               "select" => array("*"),
               "order" => array(),
               "filter" => $hlFilter
            ));

        if ($arItem = $hlData->fetch()) {
            $arResult['WISHLESS_ITEM'] = false;
        } else {
            $arResult['WISHLESS_ITEM'] = true;
        }

        if ($arParams['ACTION'] == 'ADD') {
            if ($arResult['WISHLESS_ITEM'] == false) {
                $idForDel = $arItem['ID'];
                $result = $strEntityDataClass::delete($idForDel);
                $arResult['WISHLESS_ITEM'] = true;
            } else if (CIBlockElement::GetList([], ['IBLOCK_ID' => 3, 'ACTIVE' => 'Y'])->Fetch()) {
                $result = $strEntityDataClass::add($hlFilter);
                $arResult['WISHLESS_ITEM'] = false;
            }
        }
    }
    $this->IncludeComponentTemplate();
?>