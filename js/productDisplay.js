function changeMainImage(src)
{
	$("#mainImage").fadeOut(400,function(){
		
		$("#mainImage").attr("src",src);
		$("#mainImage").fadeIn(400);
		
	});
	
}

function showImage(src) {
 
			$('.enlargeImageModalSource').attr('src', src);
			$('#enlargeImageModal').modal('show');
	
}