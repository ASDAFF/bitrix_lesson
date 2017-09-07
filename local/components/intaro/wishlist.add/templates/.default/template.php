<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($USER->IsAuthorized()):?>
	<a 	class="wishlist-btn"
		data-product-id="<?=$arParams['PRODUCT_ID']?>"
		href="javascript:void(0)"
		style="display: block">
		<span class="wishlist-btn-add" style="display:none">Добавить в список желаний</span>
		<span class="wishlist-btn-delete" style="display:none">Удалить из списка желаний</span>
		<?if ($arParams['ACTION'] == "ADD"):?>
			<?if ($arResult['WISHLESS_ITEM']):?>
				<span class="wishlist-btn-add">Добавить в список желаний</span>
			<?else:?>
				<span class="wishlist-btn-delete">Удалить из списка желаний</span>
			<?endif?>
		<?endif?>
	</a>
<?endif?>

