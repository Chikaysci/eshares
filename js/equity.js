var loader = '<div class="ajax-wrapper-loading"><img src="http://d2qcctj8epnr7y.cloudfront.net/images/jayson/eshares/loading-ajax.gif" class="ajax-loader"><span style="">Please Wait... </span></div>';

function resetmenu(){
	$('#tab-equity-dashboard').removeClass('active');
	$('#tab-add-funds').removeClass('active');
	$('#tab-draw-funds').removeClass('active');
	$('#tab-contributions').removeClass('active');
	$('#tab-summary').removeClass('active');
	$('#tab-brand-settings').removeClass('active');
	$('#tab-member-settings').removeClass('active');
}

function loaddashboard(){
	resetmenu();
	$('#dashboard_content').html(loader);
	$('#tab-equity-dashboard').addClass('active');
    var base_url = $('#base_url').val();
	var domain = $('#domain').val();
	$.post(base_url+'/equityajax',{t:'loaddashboard',domain:domain},function(data){
		$('#dashboard_content').html(data.html);
	});
}

function loadaddfunds(){
	resetmenu();
	$('#dashboard_content').html(loader);
	var base_url = $('#base_url').val();
	var domain = $('#domain').val();
	
	$('#tab-add-funds').addClass('active');
	
	$.post(base_url+'/fundajax',{t:'addfunds',domain:domain},function(data){
		$('#dashboard_content').html(data.html);
	});
}

function loaddrawfunds(){
	resetmenu();
	$('#dashboard_content').html(loader);
	var base_url = $('#base_url').val();
	var domain = $('#domain').val();
	
	$('#tab-draw-funds').addClass('active');
	
	$.post(base_url+'/fundajax',{t:'drawfunds',domain:domain},function(data){
		$('#dashboard_content').html(data.html);
	});
}

function savedrawfund(){
	var amount = $('#draw_fund_amount').val();
	var base_url = $('#base_url').val();
	var domain = $('#domain').val();
	
	amount = parseInt(amount);
	//verify if numeric
		if(isNaN(amount)){
		   $('#drawfund_result').html('<div class="alert alert-danger"><i class="fa fa-times-circle"></i> Please enter numerical value.</div>');
		   $('#add_fund_amount').focus();
		}else{
		   $('#drawfund_result').html('<div class="alert alert-warning"><i class="fa-warning"></i> Processing... Please wait.</div>');
		   $.post(base_url+'/fundajax',{t:'savedrawfund',domain:domain,amount:amount},function(data){
				if(data.status){
					$('#drawfund_result').html('<div class="alert alert-success"><i class="fa fa-thumbs-o-up"></i> Fund successfully drawn.</div>');
				}else{
					$('#drawfund_result').html('<div class="alert alert-danger"><i class="fa fa-thumbs-o-down"></i> Sorry. An error occurred ..</div>');
				}
		   });
		}
	
}

function saveaddfund(){
	var amount = $('#add_fund_amount').val();
	var member_id = $('#add_fund_investor').val();
	var base_url = $('#base_url').val();
	var domain = $('#domain').val();
	
	amount = parseInt(amount);
	//verify if numeric
		if(isNaN(amount)){
		   $('#addfund_result').html('<div class="alert alert-danger"><i class="fa fa-times-circle"></i> Please enter numerical value.</div>');
		   $('#add_fund_amount').focus();
		}else{
		   $('#addfund_result').html('<div class="alert alert-warning"><i class="fa-warning"></i> Processing... Please wait.</div>');
		   $.post(base_url+'/fundajax',{t:'saveaddfund',domain:domain,amount:amount,member_id:member_id},function(data){
				if(data.status){
					$('#addfund_result').html('<div class="alert alert-success"><i class="fa fa-thumbs-o-up"></i> Fund successfully added.</div>');
				}else{
					$('#addfund_result').html('<div class="alert alert-danger"><i class="fa fa-thumbs-o-down"></i> Sorry. An error occurred while saving.</div>');
				}
		   });
		}
}



function loadcontributions(){
	resetmenu();
	$('#dashboard_content').html(loader);
	$('#tab-contributions').addClass('active');
	var domain = $('#domain').val();
	var base_url = $('#base_url').val();
	$.post(base_url+'/contributionajax',{domain:domain,t:'loadcontributions'},function(data){
		$('#dashboard_content').html(data.html);
	});
	
	
}


function loadsummary(){
	resetmenu();
	$('#dashboard_content').html(loader);
	$('#tab-summary').addClass('active');
	var base_url = $('#base_url').val();
	var domain = $('#domain').val();
	$.post(base_url+'/contributionajax',{domain:domain,t:'loadsummary'},function(data){
		$('#dashboard_content').html(data.html);
	});
	
}

function loadbrandsettings(){
	resetmenu();
	$('#dashboard_content').html(loader);
	$('#tab-brand-settings').addClass('active');
	var base_url = $('#base_url').val();
	var domain = $('#domain').val();
	$.post(base_url+'/settingsajax',{domain:domain,t:'loadbrand'},function(data){
		$('#dashboard_content').html(data.html);
	});
}

function loadmembersettings(){
	resetmenu();
	$('#dashboard_content').html(loader);
	$('#tab-member-settings').addClass('active');
	var base_url = $('#base_url').val();
	var domain = $('#domain').val();
	$.post(base_url+'/settingsajax',{domain:domain,t:'loadmembers'},function(data){
		$('#dashboard_content').html(data.html);
	});
}

$(function() {
	loaddashboard();
	
	$('#deleteselected').live('click',function(){
	var selectedArr = new Array();
		
		$("input:checkbox[name=cbox]:checked").each(function(){	
			var temp = $(this).val();
			selectedArr.push(temp);
		});
		
		if(selectedArr.length < 1){
			$('#notification').html('<div class="alert alert-danger"><i class="fa-warning"></i> Please select at least one.</div>');
		}else{
			var base_url = $('#base_url').val();
			
			$('#notification').html('<div class="alert alert-danger"><i class="fa-warning"></i> <img src="http://manage.vnoc.com/images/loaders/loader1.gif" alt=""/>Please wait. </div>');
			$.post(base_url+'/equityajax',{t:'deletecontribution',selectedarray:selectedArr},function(data){
				if(data.status){
					$('#notification').html('<div class="alert alert-success">Delete successful.</div>');
					loadcontributions();
				}else{
					$('#notification').html('<div class="alert alert-danger">Failed. There was an error while deleting.</div>');
				}
			});
		}
	});
	

	
	$('input[type="checkbox"][name="checkall"]').live('change',function() {
		 if(this.checked) {
			$('input:checkbox').prop('checked',true);
			console.log("check check");
		 }else{
			 $('input:checkbox').prop('checked',false);
		 }
    });
	
});