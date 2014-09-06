
function StateSuggestions() {
this.states = 
[
"RAJJ #AMF00000038","ARUN #AMF00000037","AAAA #AMF00000036","JONES #AMF00000035","PANDI #AMF00000034","BOSS #AMF00000033","DOSSBOSS #AMF00000032","VENKATESH #AMF00000031","JAI KUMAR #AMF00000030","JON #AMF00000029","JAMES #AMF00000028","DOSS #AMF00000027","RAJKUMAR #AMF00000026","THEN #AMF00000025","RAJA #AMF00000024","DOSS #AMF00000023","RAJA #AMF00000022","DOSS #AMF00000021","THEN #AMF00000020","THEN #AMF00000019","THEN #AMF00000018","THEN #AMF00000017","RAJA #AMF00000016","JON #AMF00000015","THEN #AMF00000014","JONES #AMF00000013","THEN #AMF00000012","RAMJI #AMF00000011","PREM KUMAR #AMF00000010","RAM #AMF00000009","JON #AMF00000008","THEN #AMF00000007","BAVI #AMF00000006","MOHAN #AMF00000005","MAHESH #AMF00000004","RAJA #AMF00000003","VALARMATHI #AMF00000002","CASH CUSTOMER #AMF00000001"];
}

/**
 * Request suggestions for the given autosuggest control. 
 * @scope protected
 * @param oAutoSuggestControl The autosuggest control to provide suggestions for.
 */
StateSuggestions.prototype.requestSuggestions = function (oAutoSuggestControl /*:AutoSuggestControl*/,
                                                          bTypeAhead /*:boolean*/) {
    var aSuggestions = [];
    var sTextboxValue = oAutoSuggestControl.textbox.value;
    
 	var loopLength = 0;

    if (sTextboxValue.length > 0){
    
	var sTextboxValue = sTextboxValue.toUpperCase();

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
    }

    //provide suggestions to the control
    oAutoSuggestControl.autosuggest(aSuggestions, bTypeAhead);
};