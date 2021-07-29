<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
	
	use Bitrix\Main\Engine\Contract\Controllerable;	
	use Bitrix\Main\Loader;	
	use Bitrix\Highloadblock as HL; 
	use Bitrix\Main\Entity;	
	// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
	use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
	Loader::includeModule("highloadblock");
	
	class FeaturedEntries extends CBitrixComponent implements Controllerable
	{
		private static $hlbl = 4; // Указываем ID нашего highloadblock блока к которому будет делать запросы.		
		private static $group_id = 3; //группа зарегистрированные пользователи
		
		//фильтры
		public function configureActions()
		{
			//если действия не нужно конфигурировать, то пишем просто так. И будет конфиг по умолчанию 
			return [];
		}
		
		
		//поиск записей в избранном, возвращает найденные записи		
		private function search_entries_favorites($UF_USER_ID)
		{
			
			$entity_data_class = FeaturedEntries::GetEntityDataClass(FeaturedEntries::$hlbl);			
			$arFilter = Array(
			Array(		
			"UF_USER_ID"=>$UF_USER_ID			
			)
			);
			$rsData = $entity_data_class::getList(array(
			'select' => array('*'),
			'filter' => $arFilter
			));
			while($el = $rsData->fetch()){				
				if(isset($el["UF_USER_ID"]) ) {
					$answer[] = $el;					
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
		
		
		//удалить запись в highloadblock
		public function delete_entry_favoritesAction()
		{		
			$ID = $_POST['id'];			
			$hlblock = HL\HighloadBlockTable::getById(FeaturedEntries::$hlbl)->fetch(); 
			
			$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
			$entity_data_class = $entity->getDataClass(); 
			$entity_data_class::Delete($ID);  // id удаляемой записи 
			
			
			return 0;		
		}
		
		
		
		//Компонент без component.php	
		public function executeComponent()
		{		
			global $USER;			
			$arGroupUser = $USER->GetUserGroupArray();	 
			
			// для текущего пользователя. Если не зарегистрирован то пользоваться кешем иначе сформировать новый кеш
			if (!in_array(FeaturedEntries::$group_id, $arGroupUser)) {
				$this->StartResultCache(false, $USER->GetGroups());			
			}
			else
			{
				$this->arResult = FeaturedEntries::search_entries_favorites($USER->GetID());
				$this->includeComponentTemplate();
			}
			
			return $this->arResult;
		}	
	}
	
?>		