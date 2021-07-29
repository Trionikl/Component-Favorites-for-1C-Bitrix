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
	use Bitrix\Main\UI\Extension;
	Extension::load('ui.bootstrap4');
	$this->setFrameMode(true);
?>
<div class="news-list">
		<?php
		if(\Bitrix\Main\Engine\CurrentUser::get()->getId()) { 
		?>
	<div class="user-list">
		<? foreach ($arResult as $key => $value) {?>
			<div class="row margin-row" data-id="<?=$value["ID"]?>">			
				<div class="col-md-5">				
					<img class="img-chosen" src="<?=$value['UF_IMAGE_URL']?>" alt="Тут должна была быть картинка">
				</div>			
				<div class="col-md-3">				
					<?=$value['UF_NAME']?>	
				</div>
				<div class="col-md-2">		
					<a href="<?=$value['UF_LINK_TO_RECORD']?>">Cсылка на запись</a>					
				</div>	
				<div class="col-md-2">		
					<div class="close-button">	
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-x-lg" viewBox="0 0 16 16">
							<path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
						</svg>
					</div>
				</div>
			</div>
		<?}?>		
	</div>
		<? } else { ?>	
	<div>
	<p>Авторизуйтесь, чтобы использовать функционал отложенных записей</p>
	<p><a href="/login/?login=yes&backurl=%2Flogin%2Findex.php">Cсылка на авторизацию</a></p>
	</div>	
		<?}?>
</div>