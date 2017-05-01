
var Model = function(ID)
{
    this.ID = ID
    
    function _(el)
    {
    	return document.getElementById(el);
    }
    
    this.showModal_with_content = function(msg)
    {
        _(this.ID).style.display = "block";
        _("modalBody").innerHTML = msg;
    }
    
    this.showModal = function()
    {
        _(this.ID).style.display = "block";
    }
    
    this.closeModal = function()
    {
        _(this.ID).style.display = "none";
    }
    
    this.addEvent = function(elementID,type,event)
    {
        _(elementID).addEventListener(type, event);
    }
    
    this.setColor = function(color_code)
    {
        _("modalHeader").style.background = color_code;
    }
    
};

     