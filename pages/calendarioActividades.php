
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='js/fullcalendar.css' rel='stylesheet' />
<link href='js/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='js/moment.min.js'></script>


<script src='js/fullcalendar.min.js'></script>
<script src='js/lang-all.js'></script>

<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>
</head>
<body>
    
    
    
    <div id='calendar'>
     
    </div>

</body>
</html>
<script>
$(document).ready(function() {
    
    
		var currentLangCode = 'es';

		// build the language selector's options
		$.each($.fullCalendar.langs, function(langCode) {
			$('#lang-selector').append(
				$('<option/>')
					.attr('value', langCode)
					.prop('selected', langCode == currentLangCode)
					.text(langCode)
			);
		});

		// rerender the calendar when the selected option changes
		$('#lang-selector').on('change', function() {
			if (this.value) {
				currentLangCode = this.value;
				$('#calendar').fullCalendar('destroy');
				renderCalendar();
			}
		});

		function renderCalendar() {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				//defaultDate: '2015-02-12',
                                //defaultDate: '2015-02-12',
				lang: currentLangCode,
				buttonIcons: false, // show the prev/next text
				weekNumbers: true,
				editable: true,
				eventLimit: true, // allow "more" link when too many events
                                eventClick: function(event) {if (event.id) {
                                        
                                        data2 = {ide: event.id};
                                        $.ajax({
                                            async:true,
                                            type: "POST",
                                            dataType: "html",
                                            contentType: "application/x-www-form-urlencoded",
                                            //url:"pages/crearPOA.php",    
                                            // url:"../cargarPOAs.php",       
                                             //beforeSend:inicioEnvio,
                                            success:llegadaCrear,
                                            //timeout:4000,
                                            //error:problemas
                                        }); 
                                        
                                        function llegadaCrear(){
                                           $("#contenedor").load('pages/actividad.php', data2);                                           
                                        }
                                        
                                        return false;
                                    
                                            }},
				events: "pages/eventos.php"
                                
                                
                                    });
		}
                
                
                
                
                

		renderCalendar();
	});


</script>
