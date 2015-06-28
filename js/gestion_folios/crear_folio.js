$( document ).ready(function() {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn'),
			allPrevBtn = $('.prevBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

	allPrevBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
			curStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("a"),
            prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

		$(".error_text").text("");
        $(".form-group").removeClass("has-error");
		$("input").popover("destroy");
		curStepWizard.attr('disabled','disabled');
		prevStepWizard.removeAttr('disabled').trigger('click');
    });
	
    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],textarea"),
			curCombos = curStep.find("select"),
            isValid = true;

		$(".error_text").text("");
        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false	;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
				if($(curInputs[i]).get(0).id == "Descripcion"){
				    $(curInputs[i]).popover({content: 'Por favor ingrese lo indicado en el campo', container: 'body',placement: 'top' , trigger: 'hover'});
				}else{
				    $(curInputs[i]).popover({content: 'Por favor ingrese lo indicado en el campo', container: 'body',placement: 'right' , trigger: 'hover'});
				}
            }
        }
		for(var i=0; i<curCombos.length; i++){
		    if($(curCombos[i]).get(0).id == "Organizacion"){
				if(curCombos[i].value == -1 && curCombos[i+1].value == -1){
				    $(curCombos[i]).closest(".form-group").addClass("has-error");
					$(curCombos[i+1]).closest(".form-group").addClass("has-error");
					$(".error_text").text("Debe seleccionar una organizacion o una unidad academica");
				}
			}else if($(curCombos[i]).get(0).id == "unidadAcademica"){
			    
			}else{
                if (curCombos[i].value == -1){
                    isValid = false;
                    $(curCombos[i]).closest(".form-group").addClass("has-error");
			    }
			}
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');

    $("#fin").on("click",function(e) {
	    e.preventDefault();
		if(esValido()){
		    var procedimiento = $("#section").data('pro');
		    if(procedimiento == "folio-respuesta"){
			    data ={ 
                    NroFolio:$("#NroFolio").val(),
					NroFolioRespuesta:$("#section").data('folio'),
                    fechaCreacion:$("#dp1").val(),
                    personaReferente:$("#personaReferente").val(),
                    unidadAcademica:$("#unidadAcademica option:selected").val(),
                    organizacion:$("#Organizacion option:selected").val(),
                    descripcion:$("#Descripcion").val(),
                    tipoFolio:$("#TipoFolio option:selected").val(),
                    ubicacionFisica:$("#ubicacionFisica option:selected").val(),
                    prioridad:$("#Prioridad option:selected").val(),
				    seguimiento:$("#Seguimiento option:selected").val(),
				    notas:$("#NotasSeguimiento").val(),
				    categoria:$("#Categoria option:selected").val(),
				    encargado:$("#Encargado option:selected").val(),
                    tipoProcedimiento:"insertar_con_folio_respuesta"
                };
                $.ajax({
                    async:true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url:"pages/gestion_folios/folios.php", 
                    success:llegadaGuardar,
                    timeout:4000,
                    error:problemas
                }); 
                return false;
			}else{
			    data ={ 
                    NroFolio:$("#NroFolio").val(),
                    fechaCreacion:$("#dp1").val(),
                    personaReferente:$("#personaReferente").val(),
                    unidadAcademica:$("#unidadAcademica option:selected").val(),
                    organizacion:$("#Organizacion option:selected").val(),
                    descripcion:$("#Descripcion").val(),
                    tipoFolio:$("#TipoFolio option:selected").val(),
                    ubicacionFisica:$("#ubicacionFisica option:selected").val(),
                    prioridad:$("#Prioridad option:selected").val(),
				    seguimiento:$("#Seguimiento option:selected").val(),
				    notas:$("#NotasSeguimiento").val(),
				    categoria:$("#Categoria option:selected").val(),
				    encargado:$("#Encargado option:selected").val(),
                    tipoProcedimiento:"insertar"
                };
                $.ajax({
                    async:true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url:"pages/gestion_folios/folios.php", 
                    success:llegadaGuardar,
                    timeout:4000,
                    error:problemas
                }); 
                return false;
			}
		}
	});

	$( "#cancel" ).click(function() {
	    $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/folios.php", 
                success:cargarFolios,
                timeout:4000,
                error:problemas
        }); 
        return false;
    });		
	
});
    function esValido()
	{
        var curStep = $("#step-3"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],textarea"),
			curCombos = curStep.find("select"),
            isValid = true;

        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false	;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
				$(curInputs[i]).popover({content: 'Por favor ingrese lo indicado en el campo', container: 'body',placement: 'top' , trigger: 'hover'});
            }
        }
		for(var i=0; i<curCombos.length; i++){
		    if($(curCombos[i]).get(0).id != "Encargado"){
                if (curCombos[i].value == -1){
                    isValid = false;
                    $(curCombos[i]).closest(".form-group").addClass("has-error");
			    }
			}
        }

        return isValid;
	}

    function cargarFolios()
    {
        $("#div_contenido").load('pages/gestion_folios/folios.php');
    }
	
    function llegadaGuardar()
    {
        $("#div_contenido").load('pages/gestion_folios/folios.php',data);
    }

    function problemas()
    {
        $("#div_contenido").text('Problemas en el servidor.');
    }