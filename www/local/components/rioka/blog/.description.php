<?
	if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
	
	$arComponentDescription = array(
	"NAME" => GetMessage("IBLOCK_NEWS_NAME"),
	"DESCRIPTION" => GetMessage("IBLOCK_NEWS_DESCRIPTION"),
	"ICON" => "/images/news_all.gif",
	"COMPLEX" => "Y",
	"PATH" => array(
	"ID" => "blog",			
	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS")	
	),
	);
	
?>