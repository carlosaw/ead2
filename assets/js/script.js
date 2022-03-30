setInterval(updateArea, 100);

function updateArea(){//Calcula a altura da tela
	var alturaTela = $(document.body).height();
	var posy = $('.curso_left').offset().top;
	var altura = alturaTela - posy;
	$('.curso_left, .curso_right').css('height', altura+'px');

	var ratio = 1920/1080; //video wide screen
	var video_largura = $('#video').width();
	var video_altura = video_largura / ratio;//height = width / ratio

	$('#video').css('height', video_altura+'px');
}

function marcarAssistido(obj) {
	var id = $(obj).attr('data-id');//Pega id da aula
	
	$(obj).remove();//Remove o botão de marcar como assistido

	$.ajax({
		url:'/ead/ajax/marcar_assistido/'+id,
		type:'GET'//Passa o id da aula para marcar_assistido no ajaxController
	});

}