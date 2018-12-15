function search()
{
	
	window.location.hash = "search";
	var searchIn = $(".searchInput").val().trim();
	if(searchIn != "")
	{
		$(".searchInput").val("");
		$.post("server/search.php",{searchInput: searchIn},function(data,status){
		
		$(".loader").hide();
		if(status=='success') //If request was ok
		{
		
			var response = JSON.parse(data);
			
			if(!response.success)
			{
				$(".loader").hide();
				//console.log(response.info);
				$("#modalTitle").html("Error");
				$("#modalBody").html(response.info);
				$("#genericModal").modal('show');
				
			}
			else
			{
			$("#phpResultSearch").hide();
			$("#phpResultSearch").html(response.info);
			$("#phpResultSearch").fadeTo(400,1);
			
			}	
		
		}
		else
		{
	
		}
	
	});
	}
}