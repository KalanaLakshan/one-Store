		//document starts
		$("document").ready(function(){

			
			fetchAllAdminPanelFeedbacks();
			//Fetch All User Sended Feedbacks
			function fetchAllAdminPanelFeedbacks()
			{
			        var action = "fetchAllAdminPanelFeedbacks"; 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action},
			            success: function(data){

			                $("#adminFeedbacks").html(data);
			                $("#adminFeedbacksTable").DataTable();
			            }

			        });
			    }

			    //Hide Reply Feedback Form
			    $("#replyFeedbackForm").hide();

			    //Send Reply Feedback Edit
			    $(document).on("click",".btnReplyFeedback",function(){

				    $("#replyFeedbackForm").show();

				    var thisRow = $(this).closest("tr");

				   	var orgID = thisRow.find("td:eq(1)").text();
				    
				    $("#orgID").val(orgID);

			    })

				//Send Reply Feedback
				$("#sendReply").on("click",function(){

					var replyFeedback = $("#replyFeedback").val();
					var orgID = $("#orgID").val();
					var action = "sendReplyFeedback";

					if(replyFeedback=="")
					{
						$(".replyFeedback_error").html("Please Enter Your Reply Feedback");
					}

					else
					{
						$(".replyFeedback_error").html("");
						$.ajax({

						            url: "./assests/action.php",
						            type: "POST",
						            data: {action:action,replyFeedback:replyFeedback,orgID:orgID},
						            success: function(data){

						            	if($.trim(data) == "Success")
						            	{
						            		document.getElementById("replyFeedbackForm").reset();
						            		fetchAllAdminPanelFeedbacks();
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
															  title: 'Reply Sended Successfully'
															})
														$("#replyFeedbackForm").hide();
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