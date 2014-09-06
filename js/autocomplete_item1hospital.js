
function StateSuggestions1() {
//alert ("Meow..");
this.states = 
[
"HC002 || CONSULTATION CHARGES TESTING TEXT LENGTH PRINT OUT","HC003 || NURSING CHARGES"];
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

	aSuggestions.push(varDummyValue);
    //provide suggestions to the control
    oAutoSuggestControl.autosuggest(aSuggestions, bTypeAhead);
};