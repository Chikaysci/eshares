function savebrandsettings(){
	$('#contrib-error').hide();
	$('#contrib-success').hide();
	var base_url = $('#base_url').val();
	var domain_id = $('#domain_id').val();
	var totalPoints = 0;
	var myArray = [];
	var i =1;
	$('.brand-form').each(function(){
		 
		  $(this).find('input.input_percent').each(function(){
			  myArray[i] = $(this).val();
		    totalPoints += parseInt($(this).val());
			  i++;
		  });
		  
		});
	
	if (totalPoints > 0){
	
		$.post(base_url+'/settingsajax',{
			t:'savebrandsettings',
			domain_id:domain_id,
			p: myArray
			},
			function(data){
				if (data.status){
					$('#contrib-success').show();
				}else {
					$('#contrib-error').show();
					$('#contrib-error').html(data.message);
				}
			
		});
	
	}else {
		$('#contrib-error').show();
		$('#contrib-error').html('Total percentage should be 100%');
	}
	
}

