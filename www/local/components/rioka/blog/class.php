<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
	
	use Bitrix\Main\Engine\Contract\Controllerable;
	
	use Bitrix\Main\Loader;	
	use Bitrix\Highloadblock as HL; 
	use Bitrix\Main\Entity;
	// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
	use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
	Loader::includeModule("highloadblock");
	
	class FavoritesRecordings extends CBitrixComponent	implements Controllerable
	{	
		private static $hlbl = 4; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
		
		
		//фильтры
		public function configureActions()
		{
			//если действия не нужно конфигурировать, то пишем просто так. И будет конфиг по умолчанию 
			return [];
		}
		
		//добавления записи в highloadblock
		public function add_entry_favoritesAction()
		{
			$UF_USER_ID = $_POST['user_id'];	
			$UF_RECORD_ID = $_POST['element_id'];
			
			$UF_LINK_TO_RECORD = $_POST['DETAIL_PAGE_URL'];
			$UF_NAME = $_POST['NAME'];
			$UF_IMAGE_URL = $_POST['SRC'];
			
			$answer_user_id = FavoritesRecordings::search_entries_favorites($UF_USER_ID, $UF_RECORD_ID);
						
			if ( !isset($answer_user_id) ) 
			{				
				//Bitrix\Main\Diag\Debug::writeToFile($answer, $varName = '', $fileName = '');			
				$hlblock = HL\HighloadBlockTable::getById(FavoritesRecordings::$hlbl)->fetch(); 
				$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
				$entity_data_class = $entity->getDataClass();
				
				// Массив полей для добавления
				$data = array(
				"UF_USER_ID"=>$UF_USER_ID,
				"UF_RECORD_ID"=>$UF_RECORD_ID,				
				"UF_LINK_TO_RECORD"=>$UF_LINK_TO_RECORD,
				"UF_NAME"=>$UF_NAME,
				"UF_IMAGE_URL"=>$UF_IMAGE_URL
			
				);			
				$result = $entity_data_class::add($data);				
			}
			
			return 0;		
		}
		
		
		
		//поиск записей в избранном, возвращает id пользователя		
		public function search_entries_favorites($UF_USER_ID, $UF_RECORD_ID)
		{			
			$entity_data_class = FavoritesRecordings::GetEntityDataClass(FavoritesRecordings::$hlbl);			
			$arFilter = Array(
			Array(
			"LOGIC"=>"AND",
			Array(
			"UF_USER_ID"=>$UF_USER_ID
			),
			Array(
			"UF_RECORD_ID"=>$UF_RECORD_ID
			)
			)
			);
			$rsData = $entity_data_class::getList(array(
			'select' => array('*'),
			'filter' => $arFilter
			));
			while($el = $rsData->fetch()){				
				if(isset($el["UF_USER_ID"]) ) {
					$answer = $el["UF_USER_ID"];
					break;
				}
			}
			
			return $answer;
		}		
		
		
		//Функция получения экземпляра класса:	
		private function GetEntityDataClass($HlBlockId) {
			
			if (empty($HlBlockId) || $HlBlockId < 1)
			{
				return false;
			}
			$hlblock = HLBT::getById($HlBlockId)->fetch();	
			$entity = HLBT::compileEntity($hlblock);
			$entity_data_class = $entity->getDataClass();
			return $entity_data_class;
		}	
		
		
		
	}
?>