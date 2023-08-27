    	
		//document starts
		$("document").ready(function(){

			//$("#billingContainer").hide();
/*			$("#updateBillProduct").hide();*/

			//Assign Bill Ref No
			$("#startBilling").on("click",function(){

				$("#billingContainer").show();

				var orgID = $("#orgID").val();
				var action = "assignBillRefNo";

					$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			            	$("#refNo").val(data);

			            }

			        });

			})

			
				
				fetchAllProductsForBillingDropdown();
				//Fetch All Products For Billing Dropdown
			    function fetchAllProductsForBillingDropdown()
			    {
			        var action = "fetchAllProductsForBillingDropdown";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			            	$("#billProduct").html(data);

			            }

			        });
			    }

			    //When Change Product
			    $(document).on("change","#selectBillProduct",function(){

			    	var pID = $("#selectBillProduct").val();

			    	$("#aQty").val("");
			    	fetchProductsAvailableQuantity(pID);
			    	fetchProductsPrice(pID);

			    	var millisecondsToWait = 1000;
						setTimeout(function() {
						    //alert($("#aQty").val());
						}, millisecondsToWait);

			    	$("#qty").val("");
					$("#pTotal").val("");

			    })

			    //Fetch Products Available Quantity
			    function fetchProductsAvailableQuantity(pID)
			    {
			    	var action = "fetchProductsAvailableQuantity";

			    		$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,pID:pID},
			            success: function(data){

			            	$("#aQty").val(data);

			            }

			        });	
			    }

			    //Fetch Products Price
			    function fetchProductsPrice(pID)
			    {
			    	var action = "fetchProductsPrice";

			    		$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,pID:pID},
			            success: function(data){

			            	$("#price").val(data);

			            }

			        });	
			    }

			    //When Adding Quantity
			    $(document).on("keyup","#qty",function(){

			    	var aQty = parseInt($("#aQty").val());
			    	var qty = parseInt($("#qty").val());

			    	if(qty>aQty)
			    	{
			    		alert("This Quantity is Not Available "+aQty);
			    		$("#qty").val("");
						$("#pTotal").val(pTotal);
			    	}
			    	else
			    	{
			    		var price = $("#price").val();
			    		var pTotal = qty * price; 
						$("#pTotal").val(pTotal);
			    	}

			    })


			//Add Bill Product
			$("#addBillProduct").on("click",function(e){

				e.preventDefault();

				var pID = $("#selectBillProduct").val();
				var orgID = $("#orgID").val();
				var refNo = $("#refNo").val();
				var cusName = $("#cusName").val();
				var billDate = $("#billDate").val();
				var qty = parseInt($("#qty").val());
				var aQty = parseInt($("#aQty").val());
				var price = $("#price").val();
				var pTotal = $("#pTotal").val();


				var pID_Status = false;
				var cusName_Status = false;
				var qty_Status = false;
				var availableQty_Status = false;

				if(pID=="" || pID==0)
				{
					$(".billProduct_error").html("*Please Select the Product");
				}
				else
				{
					$(".billProduct_error").html("");
					pID_Status = true;
				}

				if(cusName=="")
				{
					$(".cusName_error").html("*Please Enter the Customer Name");
				}
				else
				{
					$(".cusName_error").html("");
					cusName_Status = true;
				}

				if(qty=="" || qty<=0)
				{
					$(".qty_error").html("*Please Enter the Quantity");
				}
				else
				{
					$(".qty_error").html("");
					qty_Status = true;
				}

				if(qty<=aQty)
				{
					availableQty_Status = true;
				}

				if(pID_Status == true && cusName_Status == true && qty_Status == true && availableQty_Status == true)
				{
						var action = "addBillProduct";

			    		$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,pID:pID,orgID:orgID,refNo:refNo,qty:qty,price:price,pTotal:pTotal,billDate:billDate},
			            success: function(data){
			            	if($.trim(data) == "Success")
					        {
					            	document.getElementById("billProductForm").reset();
					            	fetchAllBilledProducts();
					            	fetchSubTotal();

			            						        const Toast = Swal.mixin({
														  toast: true,
														  position: 'top-end',
														  showConfirmButton: false,
														  timer: 3000,
														  timerProgressBar: true,
														  didOpen: (toast) => {
														    toast.addEventListener('mouseenter', Swal.stopTimer)
														    toast.addEventListener('mouseleave', Swal.resumeTimer)
														  }
														})

														Toast.fire({
														  icon: 'success',
														  title: 'Product Added Successfully'
														})
							}
							else
							{
								//alert("Please Add a Reference No");
								alert(data);
							}
			            }

			        });
				}

				else
				{
					//alert("Failed "+availableQty_Status+" "+qty_Status+" "+cusName_Status+" "+pID_Status);
				}


			})

				fetchAllBilledProducts();
				//Fetch All Billed Products
			    function fetchAllBilledProducts()
			    {
			        var action = "fetchAllBilledProducts";
			        var refNo = $("#refNo").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,refNo:refNo},
			            success: function(data){

			            	$("#billProductsTable").html(data);

			            }

			        });
			    }

				//Fetch Sub Total Products select sum(total) from billed_products where bill_ref=70;
			    function fetchSubTotal()
			    {
			        var action = "fetchSubTotal";
			        var refNo = $("#refNo").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,refNo:refNo},
			            success: function(data){

			            	$("#subTotal").val(data);

			            }

			        });
			    }

			    //When Adding Discount
			    $(document).on("keyup","#discount",function(){

			    	var subTotal = parseInt($("#subTotal").val());
			    	var discount = parseInt($("#discount").val());
			    	var serviceCharge = parseInt($("#serviceCharge").val());

			    	var total = subTotal - discount + serviceCharge;
			    	$("#total").val(total);

			    })

			    //When Adding Service Charge
			    $(document).on("keyup","#serviceCharge",function(){

			    	var subTotal = parseInt($("#subTotal").val());
			    	var discount = parseInt($("#discount").val());
			    	var serviceCharge = parseInt($("#serviceCharge").val());

			    	var total = subTotal - discount + serviceCharge;
			    	$("#total").val(total);

			    })

			    //When Sub Total Change
			    $(document).on("change","#serviceCharge",function(){

			    	var subTotal = parseInt($("#subTotal").val());
			    	var discount = parseInt($("#discount").val());
			    	var serviceCharge = parseInt($("#serviceCharge").val());

			    	var millisecondsToWait = 1000;
						setTimeout(function() {
						    var total = subTotal - discount + serviceCharge;
						}, millisecondsToWait);
			    	
			    	$("#total").val(total);

			    })

			    //Remove Billed Products
			    $(document).on("click",".btnDeleteBillProduct",function(){
			    	
			    	var bpID = $(this).attr("data-id");

			    	var thisRow = $(this).closest("tr");

			    	var pID = thisRow.find("td:eq(1)").text();
			    	var qty = thisRow.find("td:eq(3)").text();

			    	var action = "removeBillProduct";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,bpID:bpID,qty:qty,pID,pID},
			            success: function(data){

			            			fetchAllBilledProducts();
					            	fetchSubTotal();

			            						        const Toast = Swal.mixin({
														  toast: true,
														  position: 'top-end',
														  showConfirmButton: false,
														  timer: 3000,
														  timerProgressBar: true,
														  didOpen: (toast) => {
														    toast.addEventListener('mouseenter', Swal.stopTimer)
														    toast.addEventListener('mouseleave', Swal.resumeTimer)
														  }
														})

														Toast.fire({
														  icon: 'success',
														  title: 'Product Removed Successfully'
														})

			            }

			        });

			    })

			    //Reset Order
			    $("#resetOrder").on("click",function(){

			    	document.getElementById("billProductForm").reset();
			    	document.getElementById("transactionForm").reset();
			    	$("#cusName").val("");
			    	$("#refNo").val("");
			    	fetchAllBilledProducts();
					fetchSubTotal();

			    })

			    //Finish Order
			    $("#finishOrder").on("click",function(){

			    	var refNo = $("#refNo").val();
			    	var billDate = $("#billDate").val();
			    	var cusName = $("#cusName").val();
			    	var subTotal = $("#subTotal").val();
			    	var discount = $("#discount").val();
			    	var serviceCharge = $("#serviceCharge").val();
			    	var total = $("#total").val();
			    	var action = "finishOrder";

			    	var refNo_Status = false;
			    	var cusName_Status = false;
			    	var discount_Status = false;
			    	var serviceCharge_Status = false;

			    	if(refNo == "")
			    	{
			    		$(".billProduct_error").html("*Please Asign a Reference No");
			    	}
			    	else
			    	{
			    		$(".billProduct_error").html("");
			    		refNo_Status = true;
			    	}

			    	if(cusName == "")
			    	{
			    		$(".cusName_error").html("*Please Enter the Customer Name");
			    	}
			    	else
			    	{
			    		$(".cusName_error").html("");
			    		cusName_Status = true;
			    	}

			    	if(discount == "")
			    	{
			    		alert("Enter the Discount Amount");
			    	}
			    	else
			    	{
			    		discount_Status = true;
			    	}

			    	if(serviceCharge == "")
			    	{
			    		alert("Enter the Service Charge");
			    	}
			    	else
			    	{
			    		serviceCharge_Status = true;
			    	}

			    	if(refNo_Status == true && cusName_Status == true && discount_Status == true && serviceCharge_Status == true)
			    	{
			    		$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,refNo:refNo,cusName:cusName,billDate:billDate,subTotal:subTotal,discount:discount,serviceCharge:serviceCharge,total:total},
			            success: function(data){

			            				    	document.getElementById("billProductForm").reset();
										    	document.getElementById("transactionForm").reset();
										    	$("#cusName").val("");
										    	$("#refNo").val("");
										    	fetchAllBilledProducts();
												fetchSubTotal();

													const Toast = Swal.mixin({
														  toast: true,
														  position: 'top-end',
														  showConfirmButton: false,
														  timer: 3000,
														  timerProgressBar: true,
														  didOpen: (toast) => {
														    toast.addEventListener('mouseenter', Swal.stopTimer)
														    toast.addEventListener('mouseleave', Swal.resumeTimer)
														  }
														})

														Toast.fire({
														  icon: 'success',
														  title: 'Order Finished Successfully'
														})

														window.open("./invoice.php?refNo="+refNo, "_blank");

			            }

			        });
			    	}

			    	else
			    	{
			    		//alert("Failed");
			    	}

			    })


		})//document ends

