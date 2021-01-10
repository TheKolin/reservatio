$("button").click(function() {
	if($(this).prop("name") == "id_delete"){
		$("#delete").val($(this).prop("value"));
	}
});