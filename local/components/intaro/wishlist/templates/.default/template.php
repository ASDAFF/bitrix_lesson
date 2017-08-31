<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<table>
	<?php foreach ($arResult as $wishItem): $imgPath = CFile::GetPath($wishItem['DETAIL_PICTURE']);?>
		<tr>
			<td><img src="<?=$imgPath?>" style = "width: 100%; max-width: 100px"></td>
			<td><?echo $wishItem['NAME']?></td>
			<td><?echo $wishItem['DETAIL']?></td>
		</tr>
	<?php endforeach; ?>
</table>
