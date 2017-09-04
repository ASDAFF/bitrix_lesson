<?
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("InfoBlock", "OnAfterIBlockElementUpdateHandler"));
CModule::IncludeModule("highloadblock"); 

use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity; 

class InfoBlock
{
    // создаем обработчик события "OnAfterIBlockElementUpdate"
    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        if($arFields["RESULT"]) {
            AddMessage2Log("Запись с кодом ".$arFields["ID"]." изменена.");
            if ($arFields['ACTIVE'] == "N") {
                AddMessage2Log("Запись с кодом ".'123'." удалена из wishlist.");
                $hlbl = 3;
                $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

                $entity = HL\HighloadBlockTable::compileEntity($hlblock); 
                $strEntityDataClass = $entity->getDataClass(); 

                $hlData = $strEntityDataClass::getList(array(
                    "select" => array('*'),
                    "order" => array(), 
                    "filter" => array('UF_PRODUCT_ID' => $arFields['ID'])
                ));

                while ($hlItem = $hlData->Fetch()) {
                    $idForDel = $hlItem['ID'];
                    $result = $strEntityDataClass::delete($idForDel);
                    AddMessage2Log("Запись с кодом ".$idForDel." удалена из wishlist.");
                }
            }
        }
        else
            AddMessage2Log("Ошибка изменения записи ".$arFields["ID"]." (".$arFields["RESULT_MESSAGE"].").");
    }
}
?>