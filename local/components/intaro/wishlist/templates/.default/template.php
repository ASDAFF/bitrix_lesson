<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class = "wishlist-page">
	<table class = "wishlist" style="width: 100%; border-collapse: separate; border-spacing: 0 20px;">
		<?php foreach ($arResult['ITEMS'] as $wishItem): $imgPath = CFile::GetPath($wishItem['DETAIL_PICTURE']);?>
			<tr style="height: 150px;">
				<td align="center"><img src="<?=$imgPath?>" style="max-width: 100%; max-height: 150px;"></td>
				<td valign="top" style="width: 80%; height: 100%; padding: 20px;"><h4><a href="<?=$wishItem['DETAIL_PAGE_URL']?>"><?echo $wishItem['NAME']?></a></h4></td>
				<td class = "control">
					<a href="<?=$wishItem['DETAIL_PAGE_URL']?>">Купить</a>
					<br>
					<a id = "wishlist-remove-btn" href="" wishlist_item_id="<?=$wishItem['HL_BLOCK_ID']?>">Удалить</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?
		$nav = new \Bitrix\Main\UI\PageNavigation("nav-more-notice");
        $nav->allowAllRecords(true)
            ->setPageSize($arParams['NAV_PAGE_SIZE'])
            ->initFromUri();
		$nav->setRecordCount($arResult['NAV_RESULT']);
		$APPLICATION->IncludeComponent("bitrix:main.pagenavigation", "", Array(
		    	"NAV_OBJECT" => $nav,
		        "SEF_MODE" => "N"
		    ),
		    false
		);
	?> 
</div>