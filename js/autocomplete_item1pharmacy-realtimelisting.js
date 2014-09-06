
function StateSuggestions1() 
{
	//alert ("Meow..");
	this.states = 
	[
		//alert ("Meow...2")
	];
}

var arrItemPharmacy1 = []; //To hold the values of drop down.

/**
 * Request suggestions for the given autosuggest control. 
 * @scope protected
 * @param oAutoSuggestControl The autosuggest control to provide suggestions for.
 */
StateSuggestions1.prototype.requestSuggestions = function (oAutoSuggestControl /*:AutoSuggestControl*/,
                                                          bTypeAhead /*:boolean*/) 
{
    var aSuggestions = [];
    var sTextboxValue = oAutoSuggestControl.textbox.value;
    //alert (sTextboxValue);
	//Dummy value to have one intentional blank space to allow down and up keys to select items is list contains only one item.
	var varDummyValue = " "; 
	
 	var loopLength = 0;

    if (sTextboxValue.length > 0){
	
	var sTextboxValue = sTextboxValue.toUpperCase();
	//alert (sTextboxValue); //Prints value of itemname text box.

        /* 
		//Original Coding. Perfectly working with onload data build.
		//search for matching states
        for (var i=0; i < this.states.length; i++) 
		{ 
            if (this.states[i].indexOf(sTextboxValue) >= 0) 
			{
                loopLength = loopLength + 1;
				if (loopLength <= 15) //TO REDUCE THE SUGGESTIONS DROP DOWN LIST
				{
					aSuggestions.push(this.states[i]);
				}
            } 
        }
		*/
		//var arrItemPharmacy1 = [];
		
		if(document.getElementById("itemname").value!="")
		{
			var varItemSearch = document.getElementById("itemname").value;
			//alert (varItemSearch);
			if (varItemSearch != "")
			{
				//alert ("Meow...");
				ajaxprocess1autoitembuildpharmacy();		
			}
		}
				
        for (var i=0; i < arrItemPharmacy1.length; i++) 
		{ 
            if (arrItemPharmacy1[i].indexOf(sTextboxValue) >= 0) 
			{
				aSuggestions.push(arrItemPharmacy1[i]);
			}
		}
    }

	aSuggestions.push(varDummyValue);
    //provide suggestions to the control
    oAutoSuggestControl.autosuggest(aSuggestions, bTypeAhead);
};


//Ajax Code Starts Here.
var xmlHttp

function ajaxprocess1autoitembuildpharmacy()
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	} 
  
  	var varItemName = document.getElementById("itemname").value;
	//alert(varItemName);
	var url = "";
	var url="autocompletebuild_item2pharmacy.php?itemname="+varItemName+"&&RandomKey="+Math.random()+"";
    //alert(url);

	xmlHttp.onreadystatechange=stateChanged1autobuilditempharmacy 
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
} 

function stateChanged1autobuilditempharmacy() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 

	var t = "";
	t=t+xmlHttp.responseText;
	//alert(t);
	
	var varCompleteStringReturned=t;
	//alert (varCompleteStringReturned);
	//var varNewLineValue = varCompleteStringReturned.split("^^^^");
	//alert(varNewLineValue);
	//alert(varNewLineValue.length);
	//var varNewLineLength = varNewLineValue.length;
	//alert(varNewLineLength);
	//varNewLineLength = varNewLineLength - 1;
	//alert(varNewLineLength);
	
	//for (m=0;m<=varNewLineLength;m++)
	//{
		//alert (m);
		var varNewRecordValue = varCompleteStringReturned.split("^^^^");
		//alert(varNewRecordValue);
		//alert(varNewRecordValue.length);
		var varNewRecordLength = varNewRecordValue.length;
		//alert(varNewRecordLength);
		varNewRecordLength = varNewRecordLength; // - 4;
		//alert(varNewRecordLength);
		
		arrItemPharmacy1.splice(0, arrItemPharmacy1.length);

		for (i=0;i<varNewRecordLength;i++)
		{
			//var varItemCode1 = varNewRecordValue[i];
			//alert (varItemCode1);
			arrItemPharmacy1.push(varNewRecordValue[i]);
		}
	//}
	//alert (k);
	} 
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}