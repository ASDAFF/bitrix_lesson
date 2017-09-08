<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
CModule::IncludeModule("highloadblock");
CModule::IncludeModule("iblock");

class WishAdd extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $result = array(
            "PRODUCT_ID" => $arParams["PRODUCT_ID"],
            "ACTION" => $arParams["ACTION"]
        );
        return $result;
    }

    public static function getHlEntity()
    {
        $hlbl = 3;
        $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $strEntityDataClass = $entity->getDataClass();

        return $strEntityDataClass;
    }

    public static function get($request)
    {
        $entity = self::getHlEntity();
        $hlData = $entity::getList($request);

        return $hlData;
    }

    public static function add($data)
    {
        $entity = self::getHlEntity();
        $result = $entity::add($data);

        return $result;
    }

    public static function delete($id)
    {
        $entity = self::getHlEntity();
        $result = $entity::delete($id);

        return $result;
    }

    public function addAndRefresh($userId, $productId){
        $entity = self::getHlEntity();
        $filter = array(
            "UF_USER_ID"=>$userId,
            "UF_PRODUCT_ID"=>$productId
        );
        $request = array(
               "select" => array("*"),
               "order" => array(),
               "filter" => $filter
            );
        $hlData = $entity::getList($request);

        if ($arItem = $hlData->fetch()) {
            $arResult['WISHLESS_ITEM'] = false;
        } else {
            $arResult['WISHLESS_ITEM'] = true;
        }

        if ($arResult['WISHLESS_ITEM'] == false) {
            $idForDel = $arItem['ID'];
            $result = $this->delete($idForDel);
            $arResult['WISHLESS_ITEM'] = true;
            $res[$productId] = true;
        } else if (CIBlockElement::GetList([], ['IBLOCK_ID' => 3, 'ACTIVE' => 'Y'])->Fetch()) {
            $result = $this->add($filter);
            $arResult['WISHLESS_ITEM'] = false;
            $res[$productId] = false;
        }

        return $res;
    }

    public static function getAll($userId, $idArray){
        $entity = self::getHlEntity();
        $filter = array(
            "UF_USER_ID"=>$userId,
            "UF_PRODUCT_ID"=>$idArray
        );
        $request = array(
               "select" => array("*"),
               "order" => array(),
               "filter" => $filter
            );
        $hlData = $entity::getList($request);

        foreach ($idArray as $id) {
            $res[$id] = true;
        }

        while ($hlItem = $hlData->fetch()) {
            $res[$hlItem['UF_PRODUCT_ID']] = false;
        }

        return $res;
    }
}