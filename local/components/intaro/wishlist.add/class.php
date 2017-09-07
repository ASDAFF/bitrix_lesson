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

    public function get($request)
    {
        $entity = $this->getHlEntity();
        $hlData = $entity::getList($request);

        return $hlData;
    }

    public function add($data)
    {
        $entity = $this->getHlEntity();
        $result = $entity::add($data);

        return $result;
    }

    public function delete($id)
    {
        $entity = $this->getHlEntity();
        $result = $entity::delete($id);

        return $result;
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