<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($USER->IsAuthorized()):?>
	<a 	class="wishlist-btn"
		data-product-id="<?=$arParams['PRODUCT_ID']?>"
		data-wishless-item="<?=$arResult['WISHLESS_ITEM']?>"
		href="javascript:void(0)"
		style="display: block">
		<span class="wishlist-btn-add" style="display:none">Добавить в список желаний</span>
		<span class="wishlist-btn-delete" style="display:none">Удалить из списка желаний</span>
	</a>
<?endif?>

