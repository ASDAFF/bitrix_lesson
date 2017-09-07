<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
        use Bitrix\Highloadblock as HL;
        use Bitrix\Main\Entity;
        CModule::IncludeModule("highloadblock");
        CModule::IncludeModule("iblock");

    if ($USER->IsAuthorized()) {
        $userId = $USER->GetID();

        $hlFilter = array(
            "UF_USER_ID"=>$userId,
            "UF_PRODUCT_ID"=>$arParams['PRODUCT_ID']
        );

        $request = array(
               "select" => array("*"),
               "order" => array(),
               "filter" => $hlFilter
            );

        $hlData = $this->get($request);

        if ($arItem = $hlData->fetch()) {
            $arResult['WISHLESS_ITEM'] = false;
        } else {
            $arResult['WISHLESS_ITEM'] = true;
        }

        if ($arParams['ACTION'] == 'ADD') {
            if ($arResult['WISHLESS_ITEM'] == false) {
                $idForDel = $arItem['ID'];
                $result = $this->delete($idForDel);
                $arResult['WISHLESS_ITEM'] = true;
            } else if (CIBlockElement::GetList([], ['IBLOCK_ID' => 3, 'ACTIVE' => 'Y'])->Fetch()) {
                $result = $this->add($hlFilter);
                $arResult['WISHLESS_ITEM'] = false;
            }
        }
    }
    $this->IncludeComponentTemplate();