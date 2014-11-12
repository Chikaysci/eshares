 $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });

 function saveerole(member_id,domain_id){
        var type_id = $('#equity_type_'+member_id).val();
        var base_url = $('#base_url').val();
        $('#loader_'+member_id).show();
        $.post(base_url+'/settingsajax',{
			t:'savemembersettings',
			domain_id:domain_id,
			member_id:member_id,
			type_id:type_id
			},
			function(data){
				if (data.status){
					  $('#loader_'+data.id).html('saved');
				}else {
					$('#loader_'+data.id).removeClass('text-success');
					$('#loader_'+data.id).addClass('text-danger');
					$('#loader_'+data.id).html('error');
				}
			
		});
           
 }