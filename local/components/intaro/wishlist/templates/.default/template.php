<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<table style="width: 100%; border-collapse: separate; border-spacing: 0 20px;">
	<?php foreach ($arResult as $wishItem): $imgPath = CFile::GetPath($wishItem['DETAIL_PICTURE']);?>
		<tr style="height: 150px;">
			<td align="center"><img src="<?=$imgPath?>" style="max-width: 100%; max-height: 150px;"></td>
			<td valign="top" style="width: 80%; height: 100%; padding: 20px;"><h4><?echo $wishItem['NAME']?></h4></td>
			<td class = "control">
				<a href="">Купить</a>
				<br>
				<a href="">Удалить</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
