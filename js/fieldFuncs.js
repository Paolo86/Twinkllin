function isFieldEmpty(fieldid)
{
	var value = $("#" + fieldid).val();
	
	if(value == "")
		return true;
	else
		return false;
}

function isFieldMinLengthOK(fieldid,length)
{
	var value = $("#" + fieldid).val();
	
	if(value.length >= length)
		return true;
	else
		return false;
}

function areFieldsMatching(fieldid1,fieldid2)
{
	var value1 = $("#" + fieldid1).val();
	var value2 = $("#" + fieldid2).val();
	
	return value1 == value2;
}

function hasWhiteSpace(val) {
	
  
  return val.indexOf(' ') >= 0;
}