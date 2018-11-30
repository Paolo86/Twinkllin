
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
		
		
		var response = JSON.parse(data);
		
		if(response.success)
		{
			
			var item = JSON.parse(response.info);
		
			//console.log(imagesNames.length);
			changeTitleAnimation('collectionTitle',item.name);
			var html = getHTML(item);
			
			$("#phpResult").fadeOut(400,function(){
			$("#phpResult").html(html);
			$("#phpResult").fadeIn(400);
			
		});
		}
		
		
		
	


		}
		
		
	});
	
 

	}	
	
function getHTML(item)
{
	
	var imagesNames = JSON.parse(item.imagesNames);
	var linkToImageFolder = "images/jewels/" + item.id + "/";
	
	var miniImages = "";
	//Create mini images
	if(imagesNames.length > 1)
	{
		var i = 0;
		for(; i< imagesNames.length;i++)
		{
		miniImages += `<div class="col-xs-3">   
						<img class="img-responsive img-rounded" src='`+ linkToImageFolder + imagesNames[i]+`'/>  
						</div>`;
			
		}
	}
	
	
	var html = `
  <div class="row">
   <div class="col-md-6">
   <img class="img-responsive img-rounded" src='`+ linkToImageFolder + imagesNames[0]+`'/> 
   <hr/> <div class="row">
  `+
  miniImages
  +
  
  `
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
	
		return html;
	
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