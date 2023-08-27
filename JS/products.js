    	
		//document starts
		$("document").ready(function(){

				$("#updateProductBtn").hide();
				$("#resetProductBtn").hide();

				fetchAllProducts();
			    //Fetch All Products
			    function fetchAllProducts()
			    {
			        var action = "fetchAllProducts";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			                $("#products").html(data);
			                $("#productsTable").DataTable();

			            }

			        });
			    }

			    	//Update to Unavailable Product
			    	$(document).on("click",".btnUnavailableProduct",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToUnavailableProduct";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllProducts();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })

			    	//Update to Unavailable Product
			    	$(document).on("click",".btnAvailableProduct",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToAvailableProduct";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllProducts();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })

			    fetchSubCategoriesDropdown();
			    //Fetch Main Categories For Dropdown
			    function fetchSubCategoriesDropdown()
			    {
			        var action = "fetchSubCategoriesDropdown";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			            	$("#subCategoryFetched").html(data);

			            }

			        });
			    }

			    fetchBrandsDropdown();
			    //Fetch Brands For Dropdown
			    function fetchBrandsDropdown()
			    {
			        var action = "fetchBrandsDropdown";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			            	$("#brandFetched").html(data);

			            }

			        });
			    }

			    fetchSuppliersDropdown();
			    //Fetch Brands For Dropdown
			    function fetchSuppliersDropdown()
			    {
			        var action = "fetchSuppliersDropdown";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			            	$("#supplierFetched").html(data);

			            }

			        });
			    }

			    //Add Product
			    $("#addProductBtn").on("click",function(){

			    	var orgID = $("#orgID").val();
			    	var product = $("#product").val();
			    	var scID = $("#selectSubCategory").val();
			    	var bID = $("#selectBrand").val();
			    	var sID = $("#selectSupplier").val();
			    	var qty = $("#qty").val();
			    	var date = $("#date").val();
			    	var buyPrice = $("#buyPrice").val();
			    	var sellPrice = $("#sellPrice").val();
			    	var action = "addProduct";

			    	var product_Status = false;
			    	var scID_Status = false;
			    	var bID_Status = false;
			    	var sID_Status = false;
			    	var qty_Status = false;
			    	var date_Status = false;
			    	var buyPrice_Status = false;
			    	var sellPrice_Status = false;


			    	if(scID==0)
			    	{
			    		$(".selectSubCategory_error").html("*Please Select the Sub Category");
			    	}
			    	else
			    	{
			    		$(".selectSubCategory_error").html("");
			    		scID_Status = true;
			    	}

			    	if(bID==0)
			    	{
			    		$(".selectBrand_error").html("*Please Select the Brand");
			    	}
			    	else
			    	{
			    		$(".selectBrand_error").html("*");
			    		bID_Status = true;
			    	}

			    	if(sID==0)
			    	{
			    		$(".selectSupplier_error").html("*Please Select the Supplier");
			    	}
			    	else
			    	{
			    		$(".selectSupplier_error").html("");
			    		sID_Status = true;
			    	}

			    	if(product=="")
			    	{
			    		$(".product_error").html("*Please Enter the Product");
			    	}

			    	else
			    	{
			    		$(".product_error").html("");
			    		product_Status = true;
			    	}

			    	if(qty<=0)
			    	{
			    		$(".quantity_error").html("*Quantity should be grater than 0");
			    	}
			    	else
			    	{
			    		$(".quantity_error").html("");
			    		qty_Status = true;
			    	}

			    	if(date=="")
			    	{
			    		$(".date_error").html("*Please Enter the Date");
			    	}

			    	else
			    	{
			    		$(".date_error").html("");
			    		date_Status = true;
			    	}

			    	if(buyPrice<=0)
			    	{
			    		$(".buyPrice_error").html("*Buying Price should be grater than 0");
			    	}

			    	else
			    	{
			    		$(".buyPrice_error").html("");
			    		buyPrice_Status = true;
			    	}

			    	if(sellPrice<=0)
			    	{
			    		$(".sellPrice_error").html("*Selling Price should be grater than 0");
			    	}

			    	else
			    	{
			    		$(".sellPrice_error").html("");
			    		sellPrice_Status = true;
			    	}

			    	if(scID_Status == true && bID_Status == true && sID_Status == true && product_Status == true && qty_Status == true && date_Status == true && buyPrice_Status == true && sellPrice_Status == true)
			    	{
			    				$(".selectSubCategory_error").html("");
			    				$(".selectBrand_error").html("");
			    				$(".selectSupplier_error").html("");
			    				$(".product_error").html("");
			    				$(".quantity_error").html("");
			    				$(".date_error").html("");
			    				$(".buyPrice_error").html("");
			    				$(".sellPrice_error").html("");
			    				
			    				 
			    				$.ajax({

					            url: "./assests/action.php",
					            type: "POST",
					            data: {action:action,orgID:orgID,product:product,scID:scID,bID:bID,sID:sID,qty:qty,date:date,buyPrice:buyPrice,sellPrice:sellPrice},
					            success: function(data){

					            	if($.trim(data) == "Success")
					            	{
					            		document.getElementById("addProductForm").reset();
					            		fetchAllProducts();
					            		$("#productError").html("");
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
					            		$("#productError").html("Product Already Available");
					            	}

					            }

					        });
			    	}

			    })

			    //Delete Product
			    $(document).on("click",".btnDeleteProduct",function(){

			    	var pID = $(this).attr("data-id");
			    	var action = "deleteProduct";

									Swal.fire({
									  title: 'Are you sure?',
									  text: "Do you won't delete the Product?",
									  icon: 'warning',
									  showCancelButton: true,
									  confirmButtonColor: '#3085d6',
									  cancelButtonColor: '#d33',
									  confirmButtonText: 'Yes, delete it!'
									}).then((result) => {
									  if (result.isConfirmed) {
									  				    	$.ajax({

											            url: "./assests/action.php",
											            type: "POST",
											            data: {action:action,pID:pID},
											            success: function(data){

											            	if($.trim(data) == "Success")
											            	{
											            		fetchAllProducts();
											            			Swal.fire(
																      'Deleted!',
																      'Product has been deleted.',
																      'success'
																    )
											            	}
											            	else
											            	{
											            		alert(data);
											            	}

											            }

											        });

									  }
									})

			    })

			    //Edit Product
			    $(document).on("click",".btnEditProduct",function(){

			    	$("#addProductBtn").hide();
			    	$("#updateProductBtn").show();
			    	$("#resetProductBtn").show();

			    	var pID = $(this).attr("data-id");
			    	var thisRow = $(this).closest("tr");

			    	var product = thisRow.find("td:eq(5)").text();
			    	var scID = thisRow.find("td:eq(1)").text();
			    	var bID = thisRow.find("td:eq(2)").text();
			    	var sID = thisRow.find("td:eq(3)").text();
			    	var qty = thisRow.find("td:eq(10)").text();
			    	var buyPrice = thisRow.find("td:eq(11)").text();
			    	var sellPrice = thisRow.find("td:eq(12)").text();
			    	var date_added = thisRow.find("td:eq(13)").text();

    	
			    	$("#pID").val(pID);
			    	$("#product").val(product);
			    	$("#selectSubCategory").val(scID);
			    	$("#selectBrand").val(bID);
			    	$("#selectSupplier").val(sID);
			    	$("#qty").val(qty);
			    	$("#buyPrice").val(buyPrice);
			    	$("#sellPrice").val(sellPrice);
			    	$("#date").val(date_added);

			    	var pIDs = $("#pID").val();

			    })

			    //Reset
			    $("#resetProductBtn").on("click",function(){

			    	document.getElementById("addProductForm").reset();
			    	$("#resetProductBtn").hide();
			    	$("#updateProductBtn").hide();
			    	$("#addProductBtn").show();

			    })

			    //Update Product
			    $("#updateProductBtn").on("click",function(){

			    	var pID = $("#pID").val();
			    	var orgID = $("#orgID").val();
			    	var product = $("#product").val();
			    	var scID = $("#selectSubCategory").val();
			    	var bID = $("#selectBrand").val();
			    	var sID = $("#selectSupplier").val();
			    	var qty = $("#qty").val();
			    	var date = $("#date").val();
			    	var buyPrice = $("#buyPrice").val();
			    	var sellPrice = $("#sellPrice").val();
			    	var action = "updateProduct";

			    	var product_Status = false;
			    	var scID_Status = false;
			    	var bID_Status = false;
			    	var sID_Status = false;
			    	var qty_Status = false;
			    	var date_Status = false;
			    	var buyPrice_Status = false;
			    	var sellPrice_Status = false;


			    	if(scID==0)
			    	{
			    		$(".selectSubCategory_error").html("*Please Select the Sub Category");
			    	}
			    	else
			    	{
			    		$(".selectSubCategory_error").html("");
			    		scID_Status = true;
			    	}

			    	if(bID==0)
			    	{
			    		$(".selectBrand_error").html("*Please Select the Brand");
			    	}
			    	else
			    	{
			    		$(".selectBrand_error").html("*");
			    		bID_Status = true;
			    	}

			    	if(sID==0)
			    	{
			    		$(".selectSupplier_error").html("*Please Select the Supplier");
			    	}
			    	else
			    	{
			    		$(".selectSupplier_error").html("");
			    		sID_Status = true;
			    	}

			    	if(product=="")
			    	{
			    		$(".product_error").html("*Please Enter the Product");
			    	}

			    	else
			    	{
			    		$(".product_error").html("");
			    		product_Status = true;
			    	}

			    	if(qty<=0)
			    	{
			    		$(".quantity_error").html("*Quantity should be grater than 0");
			    	}
			    	else
			    	{
			    		$(".quantity_error").html("");
			    		qty_Status = true;
			    	}

			    	if(date=="")
			    	{
			    		$(".date_error").html("*Please Enter the Date");
			    	}

			    	else
			    	{
			    		$(".date_error").html("");
			    		date_Status = true;
			    	}

			    	if(buyPrice<=0)
			    	{
			    		$(".buyPrice_error").html("*Buying Price should be grater than 0");
			    	}

			    	else
			    	{
			    		$(".buyPrice_error").html("");
			    		buyPrice_Status = true;
			    	}

			    	if(sellPrice<=0)
			    	{
			    		$(".sellPrice_error").html("*Selling Price should be grater than 0");
			    	}

			    	else
			    	{
			    		$(".sellPrice_error").html("");
			    		sellPrice_Status = true;
			    	}

			    	if(scID_Status == true && bID_Status == true && sID_Status == true && product_Status == true && qty_Status == true && date_Status == true && buyPrice_Status == true && sellPrice_Status == true)
			    	{
			    				$(".selectSubCategory_error").html("");
			    				$(".selectBrand_error").html("");
			    				$(".selectSupplier_error").html("");
			    				$(".product_error").html("");
			    				$(".quantity_error").html("");
			    				$(".date_error").html("");
			    				$(".buyPrice_error").html("");
			    				$(".sellPrice_error").html("");
			    				
			    				 
			    				$.ajax({

					            url: "./assests/action.php",
					            type: "POST",
					            data: {action:action,pID:pID,orgID:orgID,product:product,scID:scID,bID:bID,sID:sID,qty:qty,date:date,buyPrice:buyPrice,sellPrice:sellPrice},
					            success: function(data){

					            	if($.trim(data) == "Success")
					            	{
					            		document.getElementById("addProductForm").reset();
					            		fetchAllProducts();
					            		$("#productError").html("");
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
														  title: 'Product Updated Successfully'
														})
					            	}
					            	else
					            	{
					            		$("#productError").html("Sub Category Already Available");
					            	}

					            }

					        });
			    	}

			    })			

		})//document ends

