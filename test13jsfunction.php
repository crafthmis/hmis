<input type="submit" name="Submit" id="Submit" value="Submit" onclick="return funcTestingOne(event)" />
<script language="javascript">

document.onclick = function( e )
{
   var evt = e || window.event,
       elem = evt.srcElement || evt.target,
       childClicked = false;
       
   while( elem.parentNode && !elem.id )
   {
     childClicked = true;  
     elem = elem.parentNode;
   }

   alert( "Clicked element is: "  +( (elem.id) ? (childClicked ? ("a child of \"" + elem.id + "\"")  : "\"" + elem.id + "\"") : "<NO ID SPECIFIED>" ) );
   
}


function funcTestingOne()
{
	//alert ("Testing");
}


</script>