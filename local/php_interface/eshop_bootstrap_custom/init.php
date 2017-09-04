<?
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
// файл /bitrix/php_interface/init.php
// регистрируем обработчик
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("InfoBlock", "OnAfterIBlockElementUpdateHandler"));

class InfoBlock
{
    // создаем обработчик события "OnAfterIBlockElementUpdate"
    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        if($arFields["RESULT"])
            AddMessage2Log("Запись с кодом ".$arFields["ACTIVE"]." изменена.");
        else
            AddMessage2Log("Ошибка изменения записи ".$arFields["ID"]." (".$arFields["RESULT_MESSAGE"].").");
    }
}
?>