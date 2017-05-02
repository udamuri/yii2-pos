function purchase()
{
	this.baseUrl = '';
	this.layout = '';

	this.initialScript = function()
	{	
		if(PurchaseObj.layout == 'paddupdate')
		{
			PurchaseObj.mybtn();
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

	this.mybtn = function()
	{
		$('#btn-find').unbind('click');
		$('#btn-find').on('click', function(){
			alert('tes');
		});
	}
	
}

var PurchaseObj = new purchase();