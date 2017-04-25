function purchase()
{
	this.baseUrl = '';
	this.layout = '';

	this.initialScript = function()
	{	
		if(PurchaseObj.layout == 'paddupdate')
		{
			if($('#orderpurchaseform-order_date').length > 0)
			{
				$('#orderpurchaseform-order_date').datepicker({ 
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
	      			changeYear: true
				});
			}
		}
	}
	
}

var PurchaseObj = new purchase();