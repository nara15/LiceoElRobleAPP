
var Upload = function(files){
    
    this.files = files;
    this.httpRequest = new XMLHttpRequest();
    
    this.uploadFiles = function(apiPATH, Callback)
    {
        this.httpRequest.upload.addEventListener("progress", progressHandler, false);
    	this.httpRequest.addEventListener("load", completeHandler, false);
    	this.httpRequest.addEventListener("error", errorHandler, false);
    	this.httpRequest.addEventListener("abort", abortHandler, false);
    	
    	this.httpRequest.onload = function()
    	{
    		if (this.readyState != 4 || this.status != 200)
			{
				var obj = JSON.parse(this.response);
				alert(obj.message);
			}
			else
			{
			    Callback(this.response);
			}
    	}
    	
    	this.httpRequest.open("POST", apiPATH);
    	this.httpRequest.send(files);
    };
    
};

function _(el)
{
	return document.getElementById(el);
}

function progressHandler(event)
{
	_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
	_("bar").style.width = Math.round(percent)+"%"
	
}

function completeHandler(event)
{
	_("status").innerHTML = event.target.responseText;

}
function errorHandler(event)
{
	_("status").innerHTML = "Upload Failed";

}
function abortHandler(event)
{
	_("status").innerHTML = "Upload Aborted";
}