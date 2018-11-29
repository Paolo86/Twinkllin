
function changeTitleAnimation(id,title)
{
	var current = $("#" + id).html();
	if(current == title) return;
	$("#" + id).fadeOut(400,function(){
			
			$("#" + id).html(title);
			$("#" + id).fadeIn(400);
			
		});
	
}

function displayDetails(theid)
	{
	//console.log("Function called " + theid);
	
	$.post("server/getDetails.php",{id: theid},function(data,status){
		
		if(status=='success')
		{
		
		var item = JSON.parse(data);
		
		changeTitleAnimation('collectionTitle',item.name);
		
		var html = `
  <div class="row">
   <div class="col-md-6">
   <img class="img-responsive" src='`+ item.img+`'/>
   </div>
   <div class="col-md-6">
    <p>info</p>
   </div>
  </div><!-- end row -->
`;
		$("#phpResult").html(html);


		}
		
		
	});
	
 

	}	
	
function getAll()
	{
		
	//Resotre original page title in jumbotron
	$("#collectionTitle").html('Our collection');
		
	$.post("server/db.php",{tname: "jewels"},function(data,status){
		
		$("#phpResult").hide();
		$("#phpResult").html(data).fadeIn(500);
	});
	}