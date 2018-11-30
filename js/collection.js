
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
		console.log(data);
		/*var item = JSON.parse(data);
		
		changeTitleAnimation('collectionTitle',item.name);
		
		var html = `
  <div class="row">
   <div class="col-md-6">
   <img class="img-responsive img-rounded" src='`+ item.img+`'/>
   <hr/>
     <div class="row">
		<div class="col-xs-3">   
		<img class="img-responsive img-rounded" src='`+ item.img+`'/>  
		</div>
		<div class="col-xs-3">   
		<img class="img-responsive img-rounded" src='`+ item.img+`'/>  
		</div>
		<div class="col-xs-3">   
		<img class="img-responsive img-rounded" src='`+ item.img+`'/>  
		</div>
		<div class="col-xs-3">   
		<img class="img-responsive img-rounded" src='`+ item.img+`'/>  
		</div>
	</div>

   </div>
   
   <div class="col-md-6">
    <h2>`+item.name+`</h2>
	<br/>
	<h4>$`+item.price+`</h4>
	<br/>
	<p>`+item.category+`</p>
	<br/>
	<p>`+item.description+`</p>
	<br/>
	
   </div>

`;
		$("#phpResult").fadeOut(400,function(){
			$("#phpResult").html(html);
			$("#phpResult").fadeIn(400);
			
		});
		*/


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