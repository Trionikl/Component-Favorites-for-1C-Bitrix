<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	/** @var array $arParams */
	/** @var array $arResult */
	/** @global CMain $APPLICATION */
	/** @global CUser $USER */
	/** @global CDatabase $DB */
	/** @var CBitrixComponentTemplate $this */
	/** @var string $templateName */
	/** @var string $templateFile */
	/** @var string $templateFolder */
	/** @var string $componentPath */
	/** @var CBitrixComponent $component */
	$this->setFrameMode(true);
?>
<? $time = MakeTimeStamp($arResult["TIMESTAMP_X"]); ?>

<div class="news-detail">
	<?php
		if(\Bitrix\Main\Engine\CurrentUser::get()->getId()) : 
		?>
		<div class="button-favorites" data-user="<?=$USER->GetID()?>" data-element_id="<?=$arResult["ID"]?>" data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" data-name="<?=$arResult["NAME"]?>" data-detail_page_url="<?=$arResult["DETAIL_PAGE_URL"]?>">		
			<?php
				if( 0<FavoritesRecordings::search_entries_favorites($USER->GetID(), $arResult["ID"])) { 
				?>	
				<div class="button-favorites-remove button-favorites-all">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="Fuchsia" xmlns="http://www.w3.org/2000/svg">
						<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
					</svg>
				</div>		
				<? } else { ?>		
				<div class="button-favorites-add button-favorites-all">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star" fill="Fuchsia" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
					</svg>
				</div>
			<? }?>	
		</div>
	<? endif;?>		
	
	<div class="blog-detail">
		<div class="blog-detail-img">
			<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="img">
		</div>
		<div class="blog-info">
			<span><?=$arResult["PREVIEW_TEXT"]?></span>
			<span class="blog-post-date"><?=FormatDate('<\s\p\a\n>j F Y</\s\p\a\n>', $time)?></span>
		</div>
		<div class="blog-detail-text">
			<p><?echo $arResult["DETAIL_TEXT"];?></p>
		</div>
	</div>	
</div>