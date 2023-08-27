    	
		//document starts
		$("document").ready(function(){

				fetchAllProductPriceHistory();
			    //Fetch All Product Price History
			    function fetchAllProductPriceHistory()
			    {
			        var action = "fetchAllProductPriceHistory";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			                $("#priceHistory").html(data);
			                $("#historyOfProductPriceTable").DataTable();

			            }

			        });
			    }

			  	fetchAllSalesHistory();
			    //Fetch All Product Price History
			    function fetchAllSalesHistory()
			    {
			        var action = "fetchAllSalesHistory";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			                $("#salesHistory").html(data);
			                $("#historyOfSalesTable").DataTable();	

			            }

			        });
			    }
			
			
		})//document ends

