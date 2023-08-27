    	
		//document starts
		$("document").ready(function(){

				$("#updateSubCategoryBtn").hide();
				$("#resetSubCategoryBtn").hide();

				fetchAllSubCategories();
			    //Fetch Main Categories
			    function fetchAllSubCategories()
			    {
			        var action = "fetchAllSubCategories";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			                $("#subCategories").html(data);
			                $("#subCategoriesTable").DataTable();

			            }

			        });
			    }

			    	//Update to Unavailable Sub Category
			    	$(document).on("click",".btnUnavailableSubCategory",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToUnavailableSubCategory";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllSubCategories();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })	

			    	//Update to Available Sub Category
			    	$(document).on("click",".btnAvailableSubCategory",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToAvailableSubCategory";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllSubCategories();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })	
	    

				fetchMainCategoriesDropdown();
			    //Fetch Main Categories For Dropdown
			    function fetchMainCategoriesDropdown()
			    {
			        var action = "fetchMainCategoriesDropdown";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			            	$("#mainCategoryFetched").html(data);

			            }

			        });
			    }

			    //Add Sub Category
			    $("#addSubCategoryBtn").on("click",function(){

			    	var orgID = $("#orgID").val();
			    	var subCategory = $("#subCategory").val();
			    	var mcID = $("#selectMainCategory").val();
			    	var action = "addSubCategory";

			    	var subCategory_Status = false;
			    	var mcID_Status = false;


			    	if(mcID==0)
			    	{
			    		$(".selectMainCategory_error").html("*Please Select the Main Category");
			    	}
			    	else
			    	{
			    		$(".selectMainCategory_error").html("");
			    		mcID_Status = true;
			    	}

			    	if(subCategory=="")
			    	{
			    		$(".subCategory_error").html("*Please Enter the Sub Category");
			    	}

			    	else
			    	{
			    		$(".subCategory_error").html("");
			    		subCategory_Status = true;
			    	}

			    	if(mcID_Status == true && subCategory_Status == true)
			    	{
			    				$(".subCategory_error").html("");
			    				$(".selectMainCategory_error").html("");
			    				
			    				 
			    				$.ajax({

					            url: "./assests/action.php",
					            type: "POST",
					            data: {action:action,orgID:orgID,subCategory:subCategory,mcID:mcID},
					            success: function(data){

					            	if($.trim(data) == "Success")
					            	{
					            		document.getElementById("addSubCategoryForm").reset();
					            		fetchAllSubCategories();
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
														  title: 'Sub Category Added Successfully'
														})
					            	}
					            	else
					            	{
					            		$("#subCategoryError").html("Sub Category Already Available");
					            	}

					            }

					        });
			    	}

			    })


			    //Delete Sub Category
			    $(document).on("click",".btnDeleteSubCategory",function(){

			    	var scID = $(this).attr("data-id");
			    	var action = "deleteSubCategory";

									Swal.fire({
									  title: 'Are you sure?',
									  text: "Do you won't delete the Sub Category?",
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
											            data: {action:action,scID:scID},
											            success: function(data){

											            	if($.trim(data) == "Success")
											            	{
											            		fetchAllSubCategories();
											            			Swal.fire(
																      'Deleted!',
																      'Sub Category has been deleted.',
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


			    //Edit Sub Category
			    $(document).on("click",".btnEditSubCategory",function(){

			    	$("#addSubCategoryBtn").hide();
			    	$("#updateSubCategoryBtn").show();
			    	$("#resetSubCategoryBtn").show();

			    	var scID = $(this).attr("data-id");
			    	var thisRow = $(this).closest("tr");

			    	var subCategory = thisRow.find("td:eq(3)").text();
			    	var mcID = thisRow.find("td:eq(1)").text();
    	
			    	$("#scID").val(scID);
			    	$("#subCategory").val(subCategory);

			    	var scIDs = $("#scID").val();
			    	$("#selectMainCategory").val(mcID);

			    })

			    //Reset
			    $("#resetSubCategoryBtn").on("click",function(){

			    	document.getElementById("addSubCategoryForm").reset();
			    	$("#resetSubCategoryBtn").hide();
			    	$("#updateSubCategoryBtn").hide();
			    	$("#addSubCategoryBtn").show();

			    })

			    //Update Sub Category
			    $("#updateSubCategoryBtn").on("click",function(e){

					e.preventDefault();

			    	var orgID = $("#orgID").val();
			    	var scID = $("#scID").val();
			    	var subCategory = $("#subCategory").val();
			    	var mcID = $("#selectMainCategory").val();
			    	var action = "updateSubCategory";

			    	var subCategory_Status = false;
			    	var mcID_Status = false;

			    	if(mcID==0)
			    	{
			    		$(".selectMainCategory_error").html("*Please Select the Main Category");
			    	}
			    	else
			    	{
			    		$(".selectMainCategory_error").html("");
			    		mcID_Status = true;
			    	}

			    	if(subCategory=="")
			    	{
			    		$(".subCategory_error").html("*Please Enter the Sub Category");
			    	}

			    	else
			    	{
			    		$(".subCategory_error").html("");
			    		subCategory_Status = true;
			    	}

			    	if(mcID_Status == true && subCategory_Status == true)
			    	{
			    				$(".subCategory_error").html("");
			    				$(".selectMainCategory_error").html("");
			    				
			    				 
			    				$.ajax({

					            url: "./assests/action.php",
					            type: "POST",
					            data: {action:action,orgID:orgID,subCategory:subCategory,mcID:mcID,scID,scID},
					            success: function(data){

					            	if($.trim(data) == "Success")
					            	{
					            		document.getElementById("addSubCategoryForm").reset();
					            		fetchAllSubCategories();
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
														  title: 'Sub Category Updated Successfully'
														})
					            	}
					            	else
					            	{
					            		$("#subCategoryError").html("Sub Category Already Available");
					            		alert(data);
					            	}

					            }

					        });
			    	}


			    	})

		})//document ends

