function showaddcontribution(contrib,member_id){
	var domain = $('#domain').val();
	var base_url = $('#base_url').val();
	$.post(base_url+'/contributionajax',{
		t:'showaddcontribution',
		contrib:contrib,
		member_id:member_id,
		domain:domain
		},
		function(data){
		$('.modal-content').html(data.html);
		$("#myModal").modal('show');  
	});
	
}

function savecontribution(){
	var base_url = $('#base_url').val();
	var description = $('#c_description').val();
	var amount = $('#c_amount').val();
	var member_id = $('#member_id').val();
	var domain = $('#domain').val();
	var contrib = $('#contrib').val();
	
	$.post(base_url+'/contributionajax',{
		t:'savecontribution',
		member_id:member_id,
		domain:domain,
		description:description,
		amount:amount,
		contrib:contrib
		},
		function(data){
			if (data.status){
				window.location.href = base_url+'/equity/details/t/'+domain;
			}else {
				$('#contrib-error').show();
				$('#contrib-error').html('An error occured while submitting form');
			}
		
	});
}