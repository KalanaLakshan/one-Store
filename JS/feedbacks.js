    	
		//document starts
		$("document").ready(function(){

			$("#sendedFeedbacksTable").DataTable();

			fetchAllUserSendedFeedbacks();

			//Fetch All User Sended Feedbacks
			function fetchAllUserSendedFeedbacks()
			{
			        var action = "fetchAllUserSendedFeedbacks";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			                $("#feedbacks").html(data);
			                $("#sendedFeedbacksTable").DataTable();
			            }

			        });
			    }
			
			//Send Feedback To Admin By User
			$("#sendFeedback").on("click",function(){

				var feedback = $("#feedback").val();
				var orgID = $("#orgID").val();
				var action = "addUserFeedback";

				if(feedback=="")
				{
					$(".feedback_error").html("Please Enter Your Feedback");
				}

				else
				{
					$(".feedback_error").html("");
					$.ajax({

					            url: "./assests/action.php",
					            type: "POST",
					            data: {action:action,feedback:feedback,orgID:orgID},
					            success: function(data){

					            	if($.trim(data) == "Success")
					            	{
					            		document.getElementById("feedbackForm").reset();
					            		fetchAllUserSendedFeedbacks();
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
														  title: 'Feedback Sended Successfully'
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

			    //Delete User Feedback
			    $(document).on("click",".btnDeleteUserFeedback",function(){

			    	var nID = $(this).attr("data-id");
			    	var action = "deleteUserFeedback";

									Swal.fire({
									  title: 'Are you sure?',
									  text: "Do you won't delete the Feedback?",
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
											            data: {action:action,nID:nID},
											            success: function(data){

											            	if($.trim(data) == "Success")
											            	{
											            		fetchAllUserSendedFeedbacks();
											            			Swal.fire(
																      'Deleted!',
																      'Feedback has been deleted.',
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

		})//document ends

