<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<table style="width: 100%; border-collapse: separate; border-spacing: 0 20px;">
	<tr style="height: 150px;">
		<?php foreach ($arResult as $wishItem): $imgPath = CFile::GetPath($wishItem['DETAIL_PICTURE']);?>
			<td align="center">
				<img src="<?=$imgPath?>" style="max-width: 100%; max-height: 150px;">
				<h4><a href="<?=$wishItem['DETAIL_PAGE_URL']?>"><?echo $wishItem['NAME']?></a></h4>
			</td>
		<?php endforeach; ?>
	</tr>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]) :?> 
<br /><?=$arResult["NAV_STRING"]?> 
<?endif;?> 
