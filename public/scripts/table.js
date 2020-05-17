$(document).ready(function() {
      function load_data(page)
      {  
	loading_show();
	console.log (page);
	let get_url = "/ajax/pages/"+page;
	console.log (get_url);
           $.ajax({  
                url:get_url,  
                method:"GET",  
                success:function(data){  
//			loading_hide();
			$('#pagination_data').html(data);  
                }  
           })  
      }  

      load_data(1);

      $(document).on('click', '.page-item', function(){  
           var page = $(this).attr("id");  
           load_data(page);  
      });  
});

function loading_show()
{
$('#pagination_data').html("<center><img src='/public/images/loading.gif'/><center>").fadeIn('fast');
}

function loading_hide()
{
$('#pagination_data').fadeOut();
} 