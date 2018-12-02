



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
	//console.log("Details called " + theid);

	var lastID = theid;
	localStorage.setItem("lastID", lastID);
	
	$("#detailsTitle").hide();
	$('#phpResult').fadeTo( 400, 0 );
	$("#collectionTitle").fadeTo(400,0);
	$('.collectionJumboButtons').fadeTo( 400, 0,function(){
		
		$('#collectionJumboButtons').hide();
		
		$(".loader").show();
		$.post("server/getDetails.php",{id: theid},function(data,status){
		
		if(status=='success')
		{
			$(".loader").hide();
			
			var response = JSON.parse(data);
			
			if(response.success)
			{
				
				window.location.hash = "details";
				$("#phpResultDetails").hide();
				$("#detailsTitle").hide();
				var item = JSON.parse(response.info);
			
				
				var html = getHTML(item);
				
				
				$("#phpResultDetails").html(html);
				$("#phpResultDetails").fadeTo(400,1);
				$("#detailsTitle").html('<a  onclick="backToCollection() "class="backLink"><span class="glyphicon glyphicon-menu-left"></span></a>' + "   " + item.name);
				$("#detailsTitle").fadeTo(400,1);
				$("#detailsTitle").show();	
			}
			else
			{
				$(".loader").hide();
				//console.log(response.info);
				$("#modalTitle").html("Error");
				$("#modalBody").html(response.info);
				$("#genericModal").modal('show');
			}

		}
		else{
				$(".loader").hide();
			c
		}
		
		
	});
		
		
		
		
	});
	

	
 

	}	
	
function backToCollection()
{
	
	window.location.hash = "collection";	
	
}
	
//Display product details
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
						<img style="margin-top: 5pt" onclick="changeMainImage(src)" class="img-responsive img-rounded productImage" src='`+ linkToImageFolder + imagesNames[i]+`'/>  
						</div>`;
			
		}
	}
	
	
	var html = `
  <div class="row">
   <div class="col-md-6">
   <div class="col-fixed">
   <img id="mainImage" onclick="showImage(src) "class="img-responsive img-rounded productImage" style=" max-height: 100%;" src='`+ linkToImageFolder + imagesNames[0]+`'/> 
   </div>
   <hr/> <div class="row">
  `+
  miniImages
  +
  
  `
</div>
   </div>
   
   <div class="col-md-6">
    <h2>`+item.name+`</h2>
		<p>`+item.category+`</p>
	<br/>
	<h4>$`+item.price+`</h4>
	

	<br/>
	<p>`+item.description+`</p>
	<br/>
	<button type="button"  class="btn btn-primary btn-lg"  onclick="">Buy now</button>
	
   </div>
   
    <div class="modal fade" id="enlargeImageModal" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        </div>
        <div class="modal-body">
          <img src="" class="enlargeImageModalSource img-rounded" style="width: 100%;">
        </div>
      </div>
    </div>
</div>

`;
	
		return html;
	
}

function checkRefresh()
{
	
	if(window.location.hash == "#collection")
		getAll(true);
	
	if(window.location.hash == "#details")
	{
		var lastID = localStorage.getItem("lastID");
		displayDetails(lastID);
	}
		
}
	
//IMPORTANT
// THIS FUNCTION IS CALLED IN INDEX.JS, WHEN THE HASH CHANGE TO COLLECTION
function getAll(isRefresh,order = 'Name',cat="")
	{
		if(cat == "All")
			cat = ""; //Set to empty so an empty value is sent to server
	
	//If the objects have been already returned and it's not a refresh, don't send another request to server
	if ( $('#phpResult').children().length > 0 && !isRefresh) {
    $(".collectionJumboButtons").fadeTo(400,1);
	$("#collectionTitle").fadeTo(400,1);
	$("#phpResult").fadeTo(400,1);
	return;
	}
	
	$(".collectionJumboButtons").hide(); //Use hide, so the buttons are not present 
	$("#phpResult").fadeTo(0,0);
	$("#collectionTitle").fadeTo(0,0);
	
	$(".loader").show();
	$.post("server/db.php",{orderby: order,category: cat},function(data,status){
		
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
			$("#phpResult").hide();
			$("#phpResult").html(response.info);
			$("#phpResult").fadeTo(400,1);
			$(".collectionJumboButtons").fadeTo(400,1);
			$("#collectionTitle").fadeTo(400,1);	
			}	
		
		}
		else
		{
	
		}
	
	});
	}
	
var order = 'Name'; //Set default
var category = '';

function setCategory(cat)
{
	category = cat;
	$("#categoryButtonText").html(cat);
	rearrangeCollection();
	
}

function setOrder(ord)
{
	order = ord;
	$("#orderByButtonText").html(ord);
	rearrangeCollection();
}
function rearrangeCollection()
{
	 
	//console.log("Rearranging by " + order + ' category: ' + category);
	getAll(true,order,category);
	//
	
}