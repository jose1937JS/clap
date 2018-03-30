$(() => {

	$('.modal').modal();

	$('#select').material_select();

	$('.tooltipped').tooltip({delay: 50});

	//ENVIAR RESPUESTA CON EL ICONO
	$('#respuesta').click(() => {
		$('#res').submit()
	})

	// RELOOOJJ
	setInterval(() => {
		let clock   = new Date(),
			hora    = clock.getHours(),
			min	    = clock.getMinutes(),
			seg	    = clock.getSeconds(),
			dia     = clock.getDay(),
			diaN	= clock.getDate(),
			mesN	= clock.getMonth(),
			anio	= clock.getFullYear(),
			sem     = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
			mes     = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
			hor     = $('#hora'),
			fec     = $('#fecha');

		if (hora < 10) { hora = '0' + hora }
		if (min  < 10) { min  = '0' + min  }
		if (seg  < 10) { seg  = '0' + seg  }
		
		hor.html(hora +':'+ min+':'+seg) ;
		fec.html(sem[dia] +', '+ diaN +' '+ mes[mesN] +' '+ anio);
		// console.log('el interval funciona ar pelo ---------------------------------------------------------------------->>')
	}, 1000)


	// ENVIAR ESTATUS A LA BD
	let checks = $(':checkbox');

	checks.each((index, elem)=> {
		$(this).on('change', (e)=> {
			let data = e.target.parentElement.offsetParent.parentElement.cells[3].innerText;
			$.ajax({
		    
			    url : '../php/ajax_gibert.php',	 	
			    data: {
			    	codigo	: data
			    },
			    type : 'POST',	    

			    success : function(data) {
			    	console.log(data)
			    },
			    error : function(xhr, status) {
			    	console.log(xhr)
			    }
			})

		})
	})


	// Mostrar clave
	$('#oculto').hover(() => {
		$('#pass').attr('type', 'text')
	}, () => {
		$('#pass').attr('type', 'password')
	})


	// FUNCIONALIDADFESD DE AJAX
	
})