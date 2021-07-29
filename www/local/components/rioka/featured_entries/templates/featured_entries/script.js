$(document).ready(function() {
	/** начнёт работу тогда, когда будет готов DOM, за исключением картинок **/
	// ваш код	
	$('.close-button').on('click', function() {	
		var del_element = this;
		let id = $(del_element).parents(".margin-row").data("id");	
		var formData = new FormData();		
		formData.append("id", id);
			
		BX.ajax.runComponentAction("rioka:featured_entries", "delete_entry_favorites", {
			mode: "class",
			data: formData,
			type:     "POST", //метод отправки
			contentType: false,
			processData: false,
			dataType: "html" //формат данных
			}).then(function (response) {
			// обработка ответа	
			$(del_element).parents(".margin-row").addClass('d-none'); 
		});		
	});	
});