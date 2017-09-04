<?
define('NEED_AUTH', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои желания");?>
<?$APPLICATION->IncludeComponent("intaro:wishlist", "", array(
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"WISHLIST_HL_ID" => 3,
	"NAV_PAGE_SIZE" => 5,
	"CATALOG_IBLOCK_ID" => 2,
	)
)?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>