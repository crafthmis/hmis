<?php
if ($delbillst == 'billedit' && $delbillnumber != '')
{
//echo 'inside if';
$query41 = "select * from purchase_details where billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'deleted'";
$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
while ($res41 = mysql_fetch_array($exec41))
{
$itemcount = $itemcount + 1;
$varItemCode = $res41['itemcode'];
$varItemName = $res41['itemname'];
$varItemMRP = $res41['rate'];
$varItemQuantity = $res41['quantity'];
$varItemFreeQuantity = $res41['itemfreequantity'];
$varItemFreeQuantity = round($varItemFreeQuantity);
$varItemTotalQuantity = $res41['itemtotalquantity'];
$varItemTotalQuantity = round($varItemTotalQuantity);
$varItemQuantity = round($varItemQuantity, 4);
$varItemDiscountPercent = '';
if ($varItemDiscountPercent == '') $varItemDiscountPercent = '0.00';
$varItemDiscountRupees = '';
if ($varItemDiscountRupees == '') $varItemDiscountRupees = '0.00';
$varItemBatchNumber = $res41['batchnumber'];

$varItemExpiryDate = $res41['expirydate'];
$expirymonth = substr($varItemExpiryDate, 5, 2);
$expiryyear = substr($varItemExpiryDate, 2, 2);
$varItemExpiryDate = $expirymonth.'/'.$expiryyear;

$varItemPackageName = $res41['packagename'];
$varItemPackageName = stripslashes($varItemPackageName);
$varItemSalesPrice = $res41['salesprice'];

$query42 = "select * from purchase_tax where itemcode = '$varItemCode' and billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'deleted'";
$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
$res42 = mysql_fetch_array($exec42);

$varItemTaxPercent = $res42['taxpercent'];
$varItemTaxAnum = $res42['tax_autonumber'];
$varItemTaxName = $res42['taxname'];

$varItemTotalAmount = $res41['totalamount'];
$varItemDescription = $res41['itemdescription'];

?>
<TR id="idTR<?php echo $itemcount; ?>">
<td id="idTD1<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="serialnumber<?php echo $itemcount; ?>" value="<?php echo $itemcount; ?>" id="serialnumber<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="1" />
</td>
<td id="idTD2<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="itemcode<?php echo $itemcount; ?>" value="<?php echo $varItemCode; ?>" id="itemcode<?php echo $itemcount; ?>" style="border: 0px solid #001E6A; text-align:left" size="5" readonly="readonly" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="itemname<?php echo $itemcount; ?>" value="<?php echo $varItemName; ?>" size="30" id="itemname<?php echo $itemcount; ?>" style="border: 0px solid #001E6A; text-align:left" readonly="readonly" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="rateperunit<?php echo $itemcount; ?>" value="<?php echo $varItemMRP; ?>" id="rateperunit<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="4" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="quantity<?php echo $itemcount; ?>" value="<?php echo $varItemQuantity; ?>" id="quantity<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="2" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="freequantity<?php echo $itemcount; ?>" value="<?php echo $varItemFreeQuantity; ?>" id="freequantity<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="1" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="totalquantity<?php echo $itemcount; ?>" value="<?php echo $varItemTotalQuantity; ?>" id="totalquantity<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="2" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input type="hidden" name="discountpercent<?php echo $itemcount; ?>" value="<?php echo $varItemDiscountPercent; ?>" id="discountpercent<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="2" />
<input name="batchnumber<?php echo $itemcount; ?>" value="<?php echo $varItemBatchNumber; ?>" id="batchnumber<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="5" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input type="hidden" name="discountrupees<?php echo $itemcount; ?>" value="<?php echo $varItemDiscountRupees; ?>" id="discountrupees<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="2" />
<input name="expirydate<?php echo $itemcount; ?>" value="<?php echo $varItemExpiryDate; ?>" id="expirydate<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="3" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="packagename<?php echo $itemcount; ?>" value="<?php echo $varItemPackageName; ?>" id="packagename<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="2" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="taxpercent<?php echo $itemcount; ?>" value="<?php echo $varItemTaxPercent; ?>" id="taxpercent<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="3" />
<input type="hidden"  name="taxautonumber<?php echo $itemcount; ?>" value="<?php echo $varItemTaxAnum; ?>" id="taxautonumber<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="3" />
<input type="hidden"  name="taxname<?php echo $itemcount; ?>" value="<?php echo $varItemTaxName; ?>" id="itemtaxname<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="3" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="totalamount<?php echo $itemcount; ?>" value="<?php echo $varItemTotalAmount; ?>" id="totalamount<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="8" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="salesprice<?php echo $itemcount; ?>" value="<?php echo $varItemSalesPrice; ?>" id="salesprice<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="3" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="right" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input onClick="return btnFreeClick(<?php echo $itemcount; ?>)" name="btnfree<?php echo $itemcount; ?>" id="btnfree<?php echo $itemcount; ?>" type="hidden" value="Free" class="button" style="border: 1px solid #001E6A"/>
<input onClick="return btnDeleteClick(<?php echo $itemcount; ?>)" name="btndelete<?php echo $itemcount; ?>" id="btndelete<?php echo $itemcount; ?>" type="button" value="Del" class="button" style="border: 1px solid #001E6A"/>
</td>
</TR>
<?php
if ($varItemDescription != '')
{
?>
<TR id="idTRaddtxt<?php echo $itemcount; ?>">
<td id="idTD1<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD2<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;
<textarea name="itemdescription<?php echo $itemcount; ?>" cols="40" rows="2" id="itemdescription<?php echo $itemcount; ?>" style="border: 0px solid #001E6A;">
<?php echo $varItemDescription; ?></textarea>
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="right" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
</TR>
<?php
}
}
}
?>
<?php
if ($delbillst == 'importpurchaserequest' && $delbillnumber != '')
{
//echo 'inside if';
$query41 = "select * from purchaserequest_details where billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'deleted'";
$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
while ($res41 = mysql_fetch_array($exec41))
{
$itemcount = $itemcount + 1;
$varItemCode = $res41['itemcode'];
$varItemName = $res41['itemname'];
$varItemMRP = $res41['rate'];
$varItemQuantity = $res41['quantity'];
$varItemQuantity = round($varItemQuantity);
$varItemDiscountPercent = '';
if ($varItemDiscountPercent == '') $varItemDiscountPercent = '0.00';
$varItemDiscountRupees = '';
if ($varItemDiscountRupees == '') $varItemDiscountRupees = '0.00';

$query42 = "select * from purchaserequest_tax where itemcode = '$varItemCode' and billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'deleted'";
$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
$res42 = mysql_fetch_array($exec42);

$varItemTaxPercent = $res42['taxpercent'];
$varItemTaxAnum = $res42['tax_autonumber'];
$varItemTaxName = $res42['taxname'];

$varItemTotalAmount = $res41['totalamount'];
$varItemDescription = $res41['itemdescription'];

?>
<TR id="idTR<?php echo $itemcount; ?>">
<td id="idTD1<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="serialnumber<?php echo $itemcount; ?>" value="<?php echo $itemcount; ?>" id="serialnumber<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="1" />
</td>
<td id="idTD2<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="itemcode<?php echo $itemcount; ?>" value="<?php echo $varItemCode; ?>" id="itemcode<?php echo $itemcount; ?>" style="border: 0px solid #001E6A; text-align:left" size="10" readonly="readonly" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="itemname<?php echo $itemcount; ?>" value="<?php echo $varItemName; ?>" size="50" id="itemname<?php echo $itemcount; ?>" style="border: 0px solid #001E6A; text-align:left" readonly="readonly" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="rateperunit<?php echo $itemcount; ?>" value="<?php echo $varItemMRP; ?>" id="rateperunit<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="6" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="quantity<?php echo $itemcount; ?>" value="<?php echo $varItemQuantity; ?>" id="quantity<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="4" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="discountpercent<?php echo $itemcount; ?>" value="<?php echo $varItemDiscountPercent; ?>" id="discountpercent<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="2" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="discountrupees<?php echo $itemcount; ?>" value="<?php echo $varItemDiscountRupees; ?>" id="discountrupees<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="2" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="taxpercent<?php echo $itemcount; ?>" value="<?php echo $varItemTaxPercent; ?>" id="taxpercent<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="3" />
<input type="hidden"  name="taxautonumber<?php echo $itemcount; ?>" value="<?php echo $varItemTaxAnum; ?>" id="taxautonumber<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="3" />
<input type="hidden"  name="taxname<?php echo $itemcount; ?>" value="<?php echo $varItemTaxName; ?>" id="itemtaxname<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="3" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="totalamount<?php echo $itemcount; ?>" value="<?php echo $varItemTotalAmount; ?>" id="totalamount<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="8" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="right" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input onClick="return btnFreeClick(<?php echo $itemcount; ?>)" name="btnfree<?php echo $itemcount; ?>" id="btnfree<?php echo $itemcount; ?>" type="hidden" value="Free" class="button" style="border: 1px solid #001E6A"/>
<input onClick="return btnDeleteClick(<?php echo $itemcount; ?>)" name="btndelete<?php echo $itemcount; ?>" id="btndelete<?php echo $itemcount; ?>" type="button" value="Del" class="button" style="border: 1px solid #001E6A"/>
</td>
</TR>
<?php
if ($varItemDescription != '')
{
?>
<TR id="idTRaddtxt<?php echo $itemcount; ?>">
<td id="idTD1<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD2<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;
<textarea name="itemdescription<?php echo $itemcount; ?>" cols="40" rows="2" id="itemdescription<?php echo $itemcount; ?>" style="border: 0px solid #001E6A;">
<?php echo $varItemDescription; ?></textarea>
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="right" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
</TR>
<?php
}
}
}
?>
<?php
if ($delbillst == 'importpurchaseorder' && $delbillnumber != '')
{
//echo 'inside if';
$query41 = "select * from purchaseorder_details where billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'deleted'";
$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
while ($res41 = mysql_fetch_array($exec41))
{
$itemcount = $itemcount + 1;
$varItemCode = $res41['itemcode'];
$varItemName = $res41['itemname'];
$varItemMRP = $res41['rate'];
$varItemQuantity = $res41['quantity'];
$varItemQuantity = round($varItemQuantity);
$varItemDiscountPercent = '';
if ($varItemDiscountPercent == '') $varItemDiscountPercent = '0.00';
$varItemDiscountRupees = '';
if ($varItemDiscountRupees == '') $varItemDiscountRupees = '0.00';

$query42 = "select * from purchaseorder_tax where itemcode = '$varItemCode' and billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'deleted'";
$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
$res42 = mysql_fetch_array($exec42);

$varItemTaxPercent = $res42['taxpercent'];
$varItemTaxAnum = $res42['tax_autonumber'];
$varItemTaxName = $res42['taxname'];

$varItemTotalAmount = $res41['totalamount'];
$varItemDescription = $res41['itemdescription'];

?>
<TR id="idTR<?php echo $itemcount; ?>">
<td id="idTD1<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="serialnumber<?php echo $itemcount; ?>" value="<?php echo $itemcount; ?>" id="serialnumber<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="1" />
</td>
<td id="idTD2<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="itemcode<?php echo $itemcount; ?>" value="<?php echo $varItemCode; ?>" id="itemcode<?php echo $itemcount; ?>" style="border: 0px solid #001E6A; text-align:left" size="10" readonly="readonly" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="itemname<?php echo $itemcount; ?>" value="<?php echo $varItemName; ?>" size="50" id="itemname<?php echo $itemcount; ?>" style="border: 0px solid #001E6A; text-align:left" readonly="readonly" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="rateperunit<?php echo $itemcount; ?>" value="<?php echo $varItemMRP; ?>" id="rateperunit<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="6" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="quantity<?php echo $itemcount; ?>" value="<?php echo $varItemQuantity; ?>" id="quantity<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="4" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="discountpercent<?php echo $itemcount; ?>" value="<?php echo $varItemDiscountPercent; ?>" id="discountpercent<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="2" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="discountrupees<?php echo $itemcount; ?>" value="<?php echo $varItemDiscountRupees; ?>" id="discountrupees<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="2" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="taxpercent<?php echo $itemcount; ?>" value="<?php echo $varItemTaxPercent; ?>" id="taxpercent<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="3" />
<input type="hidden"  name="taxautonumber<?php echo $itemcount; ?>" value="<?php echo $varItemTaxAnum; ?>" id="taxautonumber<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="3" />
<input type="hidden"  name="taxname<?php echo $itemcount; ?>" value="<?php echo $varItemTaxName; ?>" id="itemtaxname<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="3" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input name="totalamount<?php echo $itemcount; ?>" value="<?php echo $varItemTotalAmount; ?>" id="totalamount<?php echo $itemcount; ?>" readonly="readonly" style="border: 0px solid #001E6A; text-align:right" size="8" />
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="right" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
<input onClick="return btnFreeClick(<?php echo $itemcount; ?>)" name="btnfree<?php echo $itemcount; ?>" id="btnfree<?php echo $itemcount; ?>" type="hidden" value="Free" class="button" style="border: 1px solid #001E6A"/>
<input onClick="return btnDeleteClick(<?php echo $itemcount; ?>)" name="btndelete<?php echo $itemcount; ?>" id="btndelete<?php echo $itemcount; ?>" type="button" value="Del" class="button" style="border: 1px solid #001E6A"/>
</td>
</TR>
<?php
if ($varItemDescription != '')
{
?>
<TR id="idTRaddtxt<?php echo $itemcount; ?>">
<td id="idTD1<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD2<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;
<textarea name="itemdescription<?php echo $itemcount; ?>" cols="40" rows="2" id="itemdescription<?php echo $itemcount; ?>" style="border: 0px solid #001E6A;">
<?php echo $varItemDescription; ?></textarea>
</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
<td id="idTD3<?php echo $itemcount; ?>" align="right" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
</TR>
<?php
}
}
}
?>