    	
		//document starts
		$("document").ready(function(){

				$("#updateMainCategoryBtn").hide();
				$("#resetMainCategoryBtn").hide();

				fetchAllMainCategories();
			    //Fetch Main Categories
			    function fetchAllMainCategories()
			    {
			        var action = "fetchAllMainCategories";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			                $("#mainCategories").html(data);
			                $("#mainCategoriesTable").DataTable();

			            }

			        });
			    }


			    	//Update to Unavailable Main Category
			    	$(document).on("click",".btnUnavailableMainCategory",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToUnavailableMainCategory";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllMainCategories();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })	

			    	//Update to Available Main Category
			    	$(document).on("click",".btnAvailableMainCategory",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToAvailableMainCategory";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllMainCategories();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })

			    //Add Main Category
			    $("#addMainCategoryBtn").on("click",function(e){

			    	e.preventDefault();

			    	var orgID = $("#orgID").val();
			    	var mainCategory = $("#mainCategory").val();
			    	var action = "addMainCategory";

			    	if(mainCategory=="")
			    	{
			    		$(".mainCategory_error").html("*Please Enter the Main Category");
			    	}

			    	else
			    	{
			    				$(".mainCategory_error").html("");
			    				 
			    				$.ajax({

					            url: "./assests/action.php",
					            type: "POST",
					            data: {action:action,orgID:orgID,mainCategory:mainCategory},
					            success: function(data){

					            	if($.trim(data) == "Success")
					            	{
					            		document.getElementById("addMainCategoryForm").reset();
					            		fetchAllMainCategories();
					            		$("#mainCategoryError").html("");
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
														  title: 'Main Category Added Successfully'
														})
					            	}
					            	else
					            	{
					            		$("#mainCategoryError").html("Main Category Already Available");
					            	}

					            }

					        });
			    	}

			    })


			    //Delete Main Category
			    $(document).on("click",".btnDeleteMainCategory",function(){

			    	var mcID = $(this).attr("data-id");
			    	var action = "deleteMainCategory";

									Swal.fire({
									  title: 'Are you sure?',
									  text: "Do you won't delete the Main Category?",
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
											            data: {action:action,mcID:mcID},
											            success: function(data){

											            	if($.trim(data) == "Success")
											            	{
											            		fetchAllMainCategories();
											            			Swal.fire(
																      'Deleted!',
																      'Main Category has been deleted.',
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

			    //Edit Main Category
			    $(document).on("click",".btnEditMainCategory",function(){

			    	$("#addMainCategoryBtn").hide();
			    	$("#updateMainCategoryBtn").show();
			    	$("#resetMainCategoryBtn").show();

			    	var mcID = $(this).attr("data-id");
			    	var thisRow = $(this).closest("tr");

			    	var mainCategory = thisRow.find("td:eq(2)").text();
    	
			    	$("#mcID").val(mcID);
			    	$("#mainCategory").val(mainCategory);

			    	var mcIDs = $("#mcID").val();

			    })


			    //Reset
			    $("#resetMainCategoryBtn").on("click",function(){

			    	document.getElementById("addMainCategoryForm").reset();
			    	$("#resetMainCategoryBtn").hide();
			    	$("#updateMainCategoryBtn").hide();
			    	$("#addMainCategoryBtn").show();

			    })

			    //Update Main Category
			    $("#updateMainCategoryBtn").on("click",function(e){

					e.preventDefault();

			    	var orgID = $("#orgID").val();
			    	var mcID = $("#mcID").val();
			    	var mainCategory = $("#mainCategory").val();
			    	var action = "updateMainCategory";

			    	if(mainCategory=="")
			    	{
			    		$(".mainCategory_error").html("*Please Enter the Main Category");
			    	}

			    	else
			    	{
			    				$(".mainCategory_error").html("");
			    				 
			    				$.ajax({

					            url: "./assests/action.php",
					            type: "POST",
					            data: {action:action,mcID:mcID,orgID:orgID,mainCategory:mainCategory},
					            success: function(data){

					            	if($.trim(data) == "Success")
					            	{
					            		document.getElementById("addMainCategoryForm").reset();
					            		fetchAllMainCategories();
					            		$("#addMainCategoryBtn").show();
			    						$("#updateMainCategoryBtn").hide();
			    						$("#resetMainCategoryBtn").hide();
			    						$("#mainCategoryError").html("");
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
														  title: 'Main Category Updated Successfully'
														})
					            	}
					            	else
					            	{
					            		$("#mainCategoryError").html("Main Category Already Available");
					            	}

					            }

					        });
			    	}


			    	})


		})//document ends

