<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    CModule::IncludeModule("highloadblock"); 

    use Bitrix\Highloadblock as HL; 
    use Bitrix\Main\Entity; 

    $hlbl = 3;
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

    $entity = HL\HighloadBlockTable::compileEntity($hlblock); 
    $strEntityDataClass = $entity->getDataClass(); 

    if (CModule::IncludeModule('highloadblock'))
    {
        $userId = $USER->GetID();

        $hlSelect = array('ID','UF_USER_ID','UF_PRODUCT_ID');
        $hlFilter = array('UF_USER_ID' => $userId);

        $hlData = $strEntityDataClass::GetList(array(), $hlFilter, false, array("nPageSize"=>50), $hlSelect);
        while ($hlItem = $hlData->Fetch())
        {
            $hlItems[] = $hlItem;

            $arSelect = array("ID", "NAME", "DETAIL", "PREVIEW_PICTURE", "CATALOG_GROUP_1");
            $arFilter = array("IBLOCK_ID"=>2, "ID"=>$hlItem['UF_PRODUCT_ID']);
            $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>50), $arSelect);
            while($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                var_dump($arFields['NAME']);
            }
        }
    }

    //$arResult['HL'] = $arItems[0]['UF_USER_ID'];
    $this->IncludeComponentTemplate();
?>