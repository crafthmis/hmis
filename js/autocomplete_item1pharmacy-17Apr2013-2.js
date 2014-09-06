
//function StateSuggestions1() {
//alert ("Meow..");
//this.states = 
//[

//];
//}




/*
var varItemPharmacy1 = "PH001 || METACIN TABLET 10MG";
var varItemPharmacy2 = "PH002 || ASPIRIN TABLETS 100MG";
var varItemPharmacy3 = "PH003 || 10 ML DISPOVAN";
var varItemPharmacy4 = "PH004 || 12NEUGABA 75";
var varItemPharmacy5 = "PH005 || 2--0 CHROMIC"; 
var varItemPharmacy6 = "PH006 || 20 DISPOVAN NEEDLE"; 
var varItemPharmacy7 = "PH007 || 20 ML SYRINGE"; 
var varItemPharmacy8 = "PH008 || 21 DISPOVAN NEEDLE"; 
var varItemPharmacy9 = "PH009 || 22 DISPOVAN NEEDLE"; 
var varItemPharmacy10 = "PH010 || 23 DISPOVAN NEEDLE"; 
var varItemPharmacy11 = "PH011 || 24 DISPOVAN NEEDLE"; 
var varItemPharmacy12 = "PH012 || 2ML DISPOVAN"; 
var varItemPharmacy13 = "PH013 || 3 ML SYRANGE"; 
var varItemPharmacy14 = "PH014 || 5ML DISPOVAN SYRING"; 
var varItemPharmacy15 = "PH015 || A TO Z SYP"; 
var varItemPharmacy16 = "PH016 || A TO Z TAB"; 
//var varItemPharmacyFull = ''+varItemPharmacy1+','+varItemPharmacy2+'';
*/


function StateSuggestions1() 
{
	//alert ("Meow..");
	

	var varItemPharmacy1 = "PH001 || METACIN TABLET 10MG";
	var varItemPharmacy2 = "PH002 || ASPIRIN TABLETS 100MG";
	var varItemPharmacy3 = "PH003 || 10 ML DISPOVAN";
	var varItemPharmacy4 = "PH004 || 12NEUGABA 75";
	var varItemPharmacy5 = "PH005 || 2--0 CHROMIC"; 
	var varItemPharmacy6 = "PH006 || 20 DISPOVAN NEEDLE"; 
	var varItemPharmacy7 = "PH007 || 20 ML SYRINGE"; 
	var varItemPharmacy8 = "PH008 || 21 DISPOVAN NEEDLE"; 
	var varItemPharmacy9 = "PH009 || 22 DISPOVAN NEEDLE"; 
	var varItemPharmacy10 = "PH010 || 23 DISPOVAN NEEDLE"; 
	var varItemPharmacy11 = "PH011 || 24 DISPOVAN NEEDLE"; 
	var varItemPharmacy12 = "PH012 || 2ML DISPOVAN"; 
	var varItemPharmacy13 = "PH013 || 3 ML SYRANGE"; 
	var varItemPharmacy14 = "PH014 || 5ML DISPOVAN SYRING"; 
	var varItemPharmacy15 = "PH015 || A TO Z SYP"; 
	var varItemPharmacy16 = "PH016 || A TO Z TAB"; 



	
	
	//alert (varItemPharmacy);
	this.states = 
	[
		//alert ("Meow...2")
		varItemPharmacy1,
		varItemPharmacy2,
		varItemPharmacy3,
		varItemPharmacy4,
		varItemPharmacy5,
		varItemPharmacy6,
		varItemPharmacy7,
		varItemPharmacy8,
		varItemPharmacy9,
		varItemPharmacy10,
		varItemPharmacy11,
		varItemPharmacy12,
		varItemPharmacy13,
		varItemPharmacy14,
		varItemPharmacy15,
		varItemPharmacy16
	];
}








/**
 * Request suggestions for the given autosuggest control. 
 * @scope protected
 * @param oAutoSuggestControl The autosuggest control to provide suggestions for.
 */
StateSuggestions1.prototype.requestSuggestions = function (oAutoSuggestControl /*:AutoSuggestControl*/,
                                                          bTypeAhead /*:boolean*/) {
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
		//Original Coding Perfectly working with onload data build.
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
		var arrItemPharmacy1 = [];
		
		var varItemPharmacy1 = "PH001 || METACIN TABLET 10MG";
		var varItemPharmacy2 = "PH002 || ASPIRIN TABLETS 100MG";
		var varItemPharmacy3 = "PH003 || 10 ML DISPOVAN";
		
		arrItemPharmacy1.push(varItemPharmacy1);
		arrItemPharmacy1.push(varItemPharmacy2);
		arrItemPharmacy1.push(varItemPharmacy3);
		
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