    	
		//document starts
		$("document").ready(function(){

				fetchTopSellingItems();
			    //Fetch Top Selling Items
			    function fetchTopSellingItems()
			    {
			        var action = "fetchTopSellingItems";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			                $("#topSellingItems").html(data);

			            }

			        });
			    }

		})//document ends

