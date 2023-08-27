    	
		//document starts
		$("document").ready(function(){

				$("#updateBrandBtn").hide();
				$("#resetBrandBtn").hide();	

				fetchAllBrands();
			    //Fetch Brands Categories
			    function fetchAllBrands()
			    {
			        var action = "fetchAllBrands";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			                $("#brands").html(data);
			                $("#brandsTable").DataTable();

			            }

			        });
			    }

			    	//Update to Unavailable Brand
			    	$(document).on("click",".btnUnavailableBrand",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToUnavailableBrand";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllBrands();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })

			    	//Update to Available Brand
			    	$(document).on("click",".btnAvailableBrand",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToAvailableBrand";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllBrands();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })

			    //Add Brand
			    $("#addBrandBtn").on("click",function(e){

			    	e.preventDefault();

			    	var orgID = $("#orgID").val();
			    	var brand = $("#brand").val();
			    	var action = "addBrand";

			    	if(brand=="")
			    	{
			    		$(".brand_error").html("*Please Enter the Brand");
			    	}

			    	else
			    	{
			    				$(".brand_error").html("");
			    				 
			    				$.ajax({

					            url: "./assests/action.php",
					            type: "POST",
					            data: {action:action,orgID:orgID,brand:brand},
					            success: function(data){

					            	if($.trim(data) == "Success")
					            	{
					            		document.getElementById("addBrandForm").reset();
					            		fetchAllBrands();
					            		$("#brandError").html("");
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
														  title: 'Brand Added Successfully'
														})
					            	}
					            	else
					            	{
					            		$("#brandError").html("Brand Already Available");
					            	}

					            }

					        });
			    	}

			    })

			    //Delete Main Brand
			    $(document).on("click",".btnDeleteBrand",function(){

			    	var bID = $(this).attr("data-id");
			    	var action = "deleteBrand";

									Swal.fire({
									  title: 'Are you sure?',
									  text: "Do you won't delete the Brand?",
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
											            data: {action:action,bID:bID},
											            success: function(data){

											            	if($.trim(data) == "Success")
											            	{
											            		fetchAllBrands();
											            			Swal.fire(
																      'Deleted!',
																      'Brand has been deleted.',
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

			    //Edit Brand
			    $(document).on("click",".btnEditBrand",function(){

			    	$("#addBrandBtn").hide();
			    	$("#updateBrandBtn").show();
			    	$("#resetBrandBtn").show();

			    	var bID = $(this).attr("data-id");
			    	var thisRow = $(this).closest("tr");

			    	var brand = thisRow.find("td:eq(2)").text();
    	
			    	$("#bID").val(bID);
			    	$("#brand").val(brand);

			    	var bIDs = $("#bID").val();

			    })

			    //Reset
			    $("#resetBrandBtn").on("click",function(){

			    	document.getElementById("addBrandForm").reset();
			    	$("#resetBrandBtn").hide();
			    	$("#updateBrandBtn").hide();
			    	$("#addBrandBtn").show();

			    })

			    //Update Brand
			    $("#updateBrandBtn").on("click",function(e){

					e.preventDefault();

			    	var orgID = $("#orgID").val();
			    	var bID = $("#bID").val();
			    	var brand = $("#brand").val();
			    	var action = "updateBrand";

			    	if(brand=="")
			    	{
			    		$(".brand_error").html("*Please Enter the Brand");
			    	}

			    	else
			    	{
			    				$(".brand_error").html("");
			    				 
			    				$.ajax({

					            url: "./assests/action.php",
					            type: "POST",
					            data: {action:action,bID:bID,orgID:orgID,brand:brand},
					            success: function(data){

					            	if($.trim(data) == "Success")
					            	{
					            		document.getElementById("addBrandForm").reset();
					            		fetchAllBrands();
					            		$("#addBrandBtn").show();
			    						$("#updateBrandBtn").hide();
			    						$("#resetBrandBtn").hide();
			    						$("#brandError").html("");
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
														  title: 'Brand Updated Successfully'
														})
					            	}
					            	else
					            	{
					            		$("#brandError").html("Brand Already Available");
					            	}

					            }

					        });
			    	}


			    	})

		})//document ends

