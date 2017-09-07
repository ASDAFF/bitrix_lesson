<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($USER->IsAuthorized()):?>
	<a class="anticache-btn" id="anticache-btn-id" data-product-id="<?=$arParams['PRODUCT_ID']?>" href="javascript:void(0)"
		style="display: block">
	</a>
<?endif?>

