<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($USER->IsAuthorized()):?>
	<a class="btn btn-link product-item-detail-buy-button" id="wishlist-btn" data-product-id="<?=$arParams['PRODUCT_ID']?>"
		href="javascript:void(0)"
		style="display: block">
		
			<?if ($arResult['WISHLESS_ITEM']):?>
			<span>Добавить в список желаний</span>
			<?else:?>
			<span>Удалить из списка желаний</span>
			<?endif?>
	</a>
<?endif?>

