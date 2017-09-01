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
        var_dump($userId);

        $hlData = $strEntityDataClass::getList(array(
           "select" => array("*"),
           "order" => array(),
           "filter" => array('UF_USER_ID' => $userId)
        ));

        while ($hlItem = $hlData->Fetch())
        {
            $arSelect = array();
            $arFilter = array("IBLOCK_ID"=>2, "ID"=>$hlItem['UF_PRODUCT_ID']);
            $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>50), $arSelect);
            while ($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                array_push($arResult, $arFields);
            }
        }
    }

    $this->IncludeComponentTemplate();
?>