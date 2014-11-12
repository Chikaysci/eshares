$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse')
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse')
        }

        height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });
    
})

 // autocomplet : this function will be executed every time we change the text
    function autosearchdomain() {
    	var min_length = 0; // min caracters to display the autocomplete
    	var base_url = $('#base_url').val();
    	var search_domain = $('#search_domain').val();
    	if (search_domain.length >= min_length) {
    		$.ajax({
    			url: base_url+'/equityajax',
    			type: 'POST',
    			data: {keyword:search_domain,t:'seachdomain' },
    			success:function(data){
    				$('#domain_list_id').show();
    				$('#domain_list_id').html(data.html);
    			}
    		});
    	} else {
    		$('#domain_list_id').hide();
    	}
    }

    // set_item : this function will be executed when we select an item
    function set_item(item) {
    	// change input value
    	$('#search_domain').val(item);
    	// hide proposition list
    	$('#domain_list_id').hide();
    }
    
    function submitsearch(){
    	var domain = $('#search_domain').val();
    	var base_url = $('#base_url').val();
    	if (domain != ''){
    		window.location.href = base_url+'/equity/details/t/'+domain;
    	}
    }
    
