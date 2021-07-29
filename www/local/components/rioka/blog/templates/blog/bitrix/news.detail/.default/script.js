$(document).ready(function() {
	/** начнёт работу тогда, когда будет готов DOM, за исключением картинок **/
	// ваш код	
	$('.button-favorites').on('click', function() {
	
		let user_id = $(".button-favorites").data("user");
		let element_id = $(".button-favorites").data("element_id");		
		let src_img = $(".button-favorites").data("src");
		let name = $(".button-favorites").data("name");
		let detail_page_url = $(".button-favorites").data("detail_page_url");
		
		
		var formData = new FormData();		
		let star_html = '<div class="button-favorites-remove button-favorites-all"> 					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="Fuchsia" xmlns="http://www.w3.org/2000/svg"> 						<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/> 					</svg> 				</div>';
		
		formData.append("user_id", user_id);
		formData.append("element_id", element_id);
		
		formData.append("SRC", src_img);
		formData.append("NAME", name);
		formData.append("DETAIL_PAGE_URL", detail_page_url);
		
		BX.ajax.runComponentAction("rioka:blog", "add_entry_favorites", {
			mode: "class",
			data: formData,
			type:     "POST", //метод отправки
			contentType: false,
			processData: false,
			dataType: "html" //формат данных
			}).then(function (response) {
			// обработка ответа
			$(".button-favorites").html(star_html);
		});		
	});	
});