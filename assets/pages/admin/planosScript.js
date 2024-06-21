$(document).ready(function(){
	
	$('#valor').on('change, keyup',function () {
		let valor = parseFloat($(this).val());

		/*
		valor === 100%
			  === 275%;
		*/

		let valorNew = (valor*300)/100;

		$('#calculate').val(valorNew);

	});
	
});	