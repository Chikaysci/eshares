var $Ctable = "";


$(document).ready(function(){
	var base_url = $('#base_url').val();
	 $Ctable = $('table#contribution-types').dataTable( {
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": base_url+"/contributionajax?t=typedatatable",
			 "aoColumns": [
			             { "bSearchable": true , "bSortable": true},
			             { "bSearchable": true , "bSortable": true},
			             {
			                 bSortable: false,
			                 mRender: function (source, type, val) { return '<a href="javascript:void(0)" onclick="editctype('+val[0]+')"><i class="ui-tooltip fa fa-pencil" style="font-size: 18px;" data-original-title="Edit"></i></a>&nbsp;<a href="javascript:void(0)" onclick="confirmdeletectype('+val[0]+')"><i class="ui-tooltip fa fa-trash-o"  style="font-size: 18px;" data-original-title="Delete"></i></a>'; }
			             }
			        ]
		} );
});

function editctype(type_id){
	 var base_url = $('#base_url').val();
		$.post(base_url+'/contributionajax',{
			t:'showaddedittype',
			type_id:type_id
			},
			function(data){
			$('.modal-content').html(data.html);
			$("#myModal").modal('show');  
		});
          
}


function confirmdeletectype(type_id){
	 var base_url = $('#base_url').val();
		$.post(base_url+'/contributionajax',{
			t:'confirmdeletetype',
			type_id:type_id
			},
			function(data){
			$('.modal-content').html(data.html);
			$("#myModal").modal('show');  
		});
         
}

function deletectype(type_id){
	 var base_url = $('#base_url').val();
		$.post(base_url+'/contributionajax',{
			t:'deletetype',
			type_id:type_id
			},
			function(data){
				$("#myModal").modal('hide');
				$Ctable.fnDraw();
		});
}



function savetype(){
	 var base_url = $('#base_url').val();
	 var ctype_id = $('#ctype_id').val();
	 var ctype_name = $('#ctype_name').val();
		$.post(base_url+'/contributionajax',{
			t:'savetype',
			type_id:ctype_id,
			type_name:ctype_name
			},
			function(data){
			 if (data.status){
				$("#myModal").modal('hide');
				$Ctable.fnDraw();
			}else{
				$("#contrib-error").show();
				$("#contrib-error").html('An error occured while saving...');
			}
		});
}

function addctype(){
	 var base_url = $('#base_url').val();
		$.post(base_url+'/contributionajax',{
			t:'addctype',
			},
			function(data){
			$('.modal-content').html(data.html);
			$("#myModal").modal('show');  
		});
      
}


function saveaddtype(){
	 var base_url = $('#base_url').val();
	 var ctype_name = $('#ctype_name').val();
		$.post(base_url+'/contributionajax',{
			t:'savetype',
			type_name:ctype_name
			},
			function(data){
			 if (data.status){
				$("#myModal").modal('hide');
				$Ctable.fnDraw();
			}else{
				$("#contrib-error").show();
				$("#contrib-error").html('An error occured while saving...');
			}
		});
}
