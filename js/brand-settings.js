var $Ctable = "";


$(document).ready(function(){
	var base_url = $('#base_url').val();
	var domain =  $('#domain').val();
	 $Ctable = $('table#t-expenses').dataTable( {
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": base_url+"/settingsajax?t=expensesdatatable&domain="+domain,
			 "aoColumns": [
			             { "bSearchable": true , "bSortable": true},
			             { "bSearchable": true , "bSortable": true},
			             { "bSearchable": true , "bSortable": true},
			             { "bSearchable": true , "bSortable": true},
			             {
			                 bSortable: false,
			                 mRender: function (source, type, val) { return '<a href="javascript:void(0)" onclick="editexpense('+val[0]+')"><i class="fa fa-pencil" data-original-title="Edit"></i></a>&nbsp;<a href="javascript:void(0)" onclick="confirmdeleexpense('+val[0]+')"><i class="fa fa-trash-o" data-original-title="Delete"></i></a>'; }
			             }
			        ]
		} );
});


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


function addexpenses(){
	var base_url = $('#base_url').val();
	$.post(base_url+'/settingsajax',{
		t:'addexpenses',
		},
		function(data){
		$('.modal-content').html(data.html);
		$("#myModal").modal('show');  
	});
}

function saveexpenses(){
	$('#expense-error').hide();
	var base_url = $('#base_url').val();
	var description = $('#ex_description').val();
	var amount = $('#ex_amount').val();
	var ex_date = $('#ex_date').val();
	var domain = $('#domain').val();
	
	if (description == ""){
      $('#expense-error').show();
      $('#expense-error').html('Please enter description');
	}else if (amount==""){
	  $('#expense-error').show();
	  $('#expense-error').html('Please enter amount');
	}else {
		
		$.post(base_url+'/settingsajax',{
			t:'saveexpenses',
			description:description,
			amount:amount,
			ex_date:ex_date,
			domain:domain
			},
			function(data){
			 if (data.status){
				$("#myModal").modal('hide');
				$Ctable.fnDraw();
			}else{
				$("#expense-error").show();
				$("#expense-error").html('An error occured while saving...');
			}
		});
	}
	
}

function editexpense(ex_id){
	var base_url = $('#base_url').val();
	$.post(base_url+'/settingsajax',{
		t:'editexpenses',
		ex_id:ex_id
		},
		function(data){
		$('.modal-content').html(data.html);
		$("#myModal").modal('show');  
	});
}

function updateexpenses(){
	$('#expense-error').hide();
	var base_url = $('#base_url').val();
	var description = $('#ex_description').val();
	var amount = $('#ex_amount').val();
	var ex_date = $('#ex_date').val();
	var domain = $('#domain').val();
	var ex_id = $('#ex_id').val();
	
	if (description == ""){
      $('#expense-error').show();
      $('#expense-error').html('Please enter description');
	}else if (amount==""){
	  $('#expense-error').show();
	  $('#expense-error').html('Please enter amount');
	}else {
		
		$.post(base_url+'/settingsajax',{
			t:'saveexpenses',
			description:description,
			amount:amount,
			ex_date:ex_date,
			domain:domain,
			ex_id:ex_id
			},
			function(data){
			 if (data.status){
				$("#myModal").modal('hide');
				$Ctable.fnDraw();
			}else{
				$("#expense-error").show();
				$("#expense-error").html('An error occured while saving...');
			}
		});
	}
}

function confirmdeleexpense(ex_id){
	 var base_url = $('#base_url').val();
		$.post(base_url+'/settingsajax',{
			t:'confirmdeleteexpense',
			ex_id:ex_id
			},
			function(data){
			$('.modal-content').html(data.html);
			$("#myModal").modal('show');  
		});
}

function deleteexpense(ex_id){
	 var base_url = $('#base_url').val();
	$.post(base_url+'/settingsajax',{
		t:'deleteexpense',
		ex_id:ex_id
		},
		function(data){
		 if (data.status){
			$("#myModal").modal('hide');
			$Ctable.fnDraw();
		}else{
			$("#expense-error").show();
			$("#expense-error").html('An error occured while saving...');
		}
	});
}
