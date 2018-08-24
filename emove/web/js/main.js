$(document).ready(function(){

	$(".rslides").responsiveSlides({
		auto 	: true,
		speed 	: 500,
		timeout : 4000,
		pause 	: true,
	});

	$('.add').on('click', function(){
		activeClass('.admin_forms', $(this).attr('id'));		
	});

	$('.view').on('click', function(){
		activeClass('.admin_lists', $(this).attr('id'));
	});

	$('#rentProduct').on('click', function(){

		if ( $('.acceptCGU').is(':checked') ) {

			$('#formRentProduct').slideDown();
			var dateFormat = "yy-mm-dd",

			from = $( ".dateTakeLocation" ).datepicker({
				defaultDate: "+1w",
				changeMonth: true,
				dateFormat: dateFormat,
				monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
				monthNamesShort: [ "Janv", "Févr", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sept", "Oct", "Nov", "Déc" ],
				firstDay: 1,
			}).on( "change", function() {
	      		to.datepicker( "option", "minDate", getDate( this ) );
	    	}),

	  		to = $( ".dateGiveLocation" ).datepicker({
	    		defaultDate: "+1w",
	    		changeMonth: true,
	    		dateFormat: dateFormat,
				monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
				monthNamesShort: [ "Janv", "Févr", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sept", "Oct", "Nov", "Déc" ],
				firstDay: 1
	  		}).on( "change", function() {
	    		from.datepicker( "option", "maxDate", getDate( this ) );
	  		});
	  		
			function getDate( element ) {
				var date;
				try {
					date = $.datepicker.parseDate( dateFormat, element.value );
				} catch( error ) {
					date = null;
				}

				return date;
			};

		}else{

			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": true,
				"progressBar": true,
				"positionClass": "toast-top-full-width",
				"preventDuplicates": false,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			};
			toastr["error"]("Pour réserver vous devez prendre connaissance et accepter les C.G.U.", "Attention");
		}

	});

});


//functions
function activeClass(class_custom, formListner){

	formListner = formListner.replace('btn_', '');
	if ( $('#'+formListner).hasClass('active') ){
		$('#'+formListner).removeClass('active');
		$('#'+formListner).hide();
	}
	else{
		$(class_custom).removeClass('active');
		$(class_custom).hide();
		$('#'+formListner).slideDown();
		$('#'+formListner).addClass('active');
	}
}