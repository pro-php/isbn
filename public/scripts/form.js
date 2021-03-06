$(document).ready(function() {
	$('form').submit(function(event) {
		var json;
		var form = this;
		event.preventDefault();
		$.ajax({
			type: $(form).attr('method'),
			url: $(form).attr('action'),
			data: new FormData(form),
			contentType: false,
			cache: false,
			processData: false,
			statusCode:
			{
                        	404: function () {
	                            alert('Ошибка: Не удалось связаться с сервером.');
                        	},
        	                403: function () {
                	            alert('Ошибка: доступ запрещен!');
				    window.setTimeout(window.location.href = "/admin/login",1000);
        	                }
			},
			success: function(result) {
				json = IsJsonString(result);
				if (!json) {
				
					alert('Ошибка обработки данных!');
				}
				else
				{
					if (json.message!='') {
						msg_show(json.status, json.message);
					}

					if (json.status=='success' && json.url=='') {
						form.reset();
					}

					if (json.url) {
						window.location.href = '/' + json.url;
					} 
				}
			}, 
		});
	});

});

function IsJsonString(str) {
    var json;
    try {
        json = JSON.parse(str);
    } catch (e) {
        return false;
    }
    return json;
}

function msg_show(valid, msg) {
    var msgClasses;

    if (valid=='success') {
       msgClasses = "alert badge-success";
	window.setTimeout(1000);
    } else {
        msgClasses = "alert badge-danger";
    }
    $("#msgAlert").removeClass().addClass(msgClasses).text(msg);
}