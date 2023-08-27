		//document starts
		$("document").ready(function(){

			$("#usersTable").DataTable();

			    fetchAllUsers();
			    //Fetch All Users
			    function fetchAllUsers()
			    {
			        var action = "fetchAllUsers";

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action},
			            success: function(data){

			                $("#users").html(data);
			                $("#usersTable").DataTable();

			            }

			        });
			    }

			    $(document).on("click",".updateUnavailableStatusBtn",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToUnavailableUser";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllUsers();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })	

			    $(document).on("click",".updateAvailableStatusBtn",function(){

			    	var dataID = $(this).attr("data-id");
			    	var action = "updateToAvailableUser";

			    	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,dataID:dataID},
			            success: function(data){

			            	if($.trim(data) == "Success")
			            	{
			            		fetchAllUsers();
			            	}
			            	else
			            	{
			            		alert(data);
			            	}

			            }

			        });

			    })

		})//document ends