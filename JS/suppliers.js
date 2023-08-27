    	
		//document starts
		$("document").ready(function(){

				$("#updateSupplierBtn").hide();
				$("#resetSupplierBtn").hide();

				fetchAllSuppliers();
			    //Fetch Main Categories
			    function fetchAllSuppliers()
			    {
			        var action = "fetchAllSuppliers";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			                $("#suppliers").html(data);
			                $("#suppliersTable").DataTable();

			            }

			        });
			    }

			    	//Update to Unavailable Supplier
			    	$(document).on("click",".btnUnavailableSupplier",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToUnavailableSupplier";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllSuppliers();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })

			    	//Update to Available Supplier
			    	$(document).on("click",".btnAvailableSupplier",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToAvailableSupplier";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllSuppliers();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })

			    //Add Supplier
			    $("#addSupplierBtn").on("click",function(){

			    	var orgID = $("#orgID").val();
			    	var supplierName = $("#supplierName").val();
			    	var supplierAddress = $("#supplierAddress").val();
			    	var supplierPhone = $("#supplierPhone").val();
			    	var action = "addSupplier";

			    	var supplierName_Status = false;
			    	var supplierAddress_Status = false;
			    	var supplierPhone_Status = false;


			    	if(supplierName=="" || supplierName.length<6)
			    	{
			    		$(".supplierName_error").html("*Supplier Name Should Be Grater than 5 Characters");
			    	}

			    	else
			    	{
			    		$(".supplierName_error").html("");
			    		supplierName_Status = true;
			    	}

			    	if(supplierAddress=="" || supplierAddress.length<10)
			    	{
			    		$(".supplierAddress_error").html("*Supplier Name Should Be Grater than 10 Characters");
			    	}

			    	else
			    	{
			    		$(".supplierAddress_error").html("");
			    		supplierAddress_Status = true;
			    	}


			    	if(supplierPhone=="" || supplierPhone.length!=10)
			    	{
			    		$(".supplierPhone_error").html("*Supplier Phone Number Should be 10 Numbers");
			    	}

			    	else
			    	{
			    		$(".supplierPhone_error").html("");
			    		supplierPhone_Status = true;
			    	}


			    	if(supplierName_Status == true && supplierAddress_Status == true && supplierPhone_Status == true)
			    	{
			    				$(".supplierName_error").html("");
			    				$(".supplierAddress_error").html("");
			    				$(".supplierPhone_error").html("");
			    				
			    				 
			    				$.ajax({

					            url: "./assests/action.php",
					            type: "POST",
					            data: {action:action,orgID:orgID,supplierName:supplierName,supplierAddress:supplierAddress,supplierPhone:supplierPhone},
					            success: function(data){

					            	if($.trim(data) == "Success")
					            	{
					            		document.getElementById("addSupplierForm").reset();
					            		fetchAllSuppliers();
					            		$("#subCategoryError").html("");
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
														  title: 'Supplier Added Successfully'
														})
					            	}
					            	else
					            	{
					            		alert(data);
					            	}

					            }

					        });
			    	}

			    })

			    //Delete Supplier
			    $(document).on("click",".btnDeleteSupplier",function(){

			    	var sID = $(this).attr("data-id");
			    	var action = "deleteSupplier";

									Swal.fire({
									  title: 'Are you sure?',
									  text: "Do you won't delete the Supplier?",
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
											            data: {action:action,sID:sID},
											            success: function(data){

											            	if($.trim(data) == "Success")
											            	{
											            		fetchAllSuppliers();
											            			Swal.fire(
																      'Deleted!',
																      'Supplier has been deleted.',
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

			    //Edit Supplier
			    $(document).on("click",".btnEditSupplier",function(){

			    	$("#addSupplierBtn").hide();
			    	$("#updateSupplierBtn").show();
			    	$("#resetSupplierBtn").show();

			    	var sID = $(this).attr("data-id");
			    	var thisRow = $(this).closest("tr");

			    	var supplierName = thisRow.find("td:eq(2)").text();
			    	var supplierAddress = thisRow.find("td:eq(3)").text();
			    	var supplierPhone = thisRow.find("td:eq(4)").text();
    	
			    	$("#sID").val(sID);
			    	$("#supplierName").val(supplierName);
			    	$("#supplierAddress").val(supplierAddress);
			    	$("#supplierPhone").val(supplierPhone);

			    	var sIDs = $("#sID").val();

			    })

			    //Reset
			    $("#resetSupplierBtn").on("click",function(){

			    	document.getElementById("addSupplierForm").reset();
			    	$("#resetSupplierBtn").hide();
			    	$("#updateSupplierBtn").hide();
			    	$("#addSupplierBtn").show();

			    })

			    //Update Supplier
			    $("#updateSupplierBtn").on("click",function(){

			    	var orgID = $("#orgID").val();
			    	var sID = $("#sID").val();
			    	var supplierName = $("#supplierName").val();
			    	var supplierAddress = $("#supplierAddress").val();
			    	var supplierPhone = $("#supplierPhone").val();
			    	var action = "updateSupplier";

			    	var supplierName_Status = false;
			    	var supplierAddress_Status = false;
			    	var supplierPhone_Status = false;


			    	if(supplierName=="" || supplierName.length<6)
			    	{
			    		$(".supplierName_error").html("*Supplier Name Should Be Grater than 5 Characters");
			    	}

			    	else
			    	{
			    		$(".supplierName_error").html("");
			    		supplierName_Status = true;
			    	}

			    	if(supplierAddress=="" || supplierAddress.length<10)
			    	{
			    		$(".supplierAddress_error").html("*Supplier Name Should Be Grater than 10 Characters");
			    	}

			    	else
			    	{
			    		$(".supplierAddress_error").html("");
			    		supplierAddress_Status = true;
			    	}


			    	if(supplierPhone == "" || (supplierPhone.length <9 || supplierPhone.length>10))
			    	{
			    		$(".supplierPhone_error").html("*Supplier Phone Number Should be 10 Numbers");
			    	}

			    	else
			    	{
			    		$(".supplierPhone_error").html("");
			    		supplierPhone_Status = true;
			    	}


			    	if(supplierName_Status == true && supplierAddress_Status == true && supplierPhone_Status == true)
			    	{
			    				$(".supplierName_error").html("");
			    				$(".supplierAddress_error").html("");
			    				$(".supplierPhone_error").html("");
			    				
			    				 
			    				$.ajax({

					            url: "./assests/action.php",
					            type: "POST",
					            data: {action:action,sID:sID,orgID:orgID,supplierName:supplierName,supplierAddress:supplierAddress,supplierPhone:supplierPhone},
					            success: function(data){

					            	if($.trim(data) == "Success")
					            	{
					            		document.getElementById("addSupplierForm").reset();
					            		fetchAllSuppliers();
					            		$("#subCategoryError").html("");
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
														  title: 'Supplier Updated Successfully'
														})
					            	}
					            	else
					            	{
					            		alert(data);
					            	}

					            }

					        });
			    	}

			    })

		})//document ends

