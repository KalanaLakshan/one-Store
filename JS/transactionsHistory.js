    	
		//document starts
		$("document").ready(function(){
			
				fetchAllTransactionsHistory();
			    //Fetch All Product Price History
			    function fetchAllTransactionsHistory()
			    {
			        var action = "fetchAllTransactionsHistory";
			        var orgID = $("#orgID").val(); 

			        $.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			                $("#transactionsHistory").html(data);
			                $("#historyOfTransactionsTable").DataTable();

			            }

			        });
			    }

			    $(document).on("click",'.viewPdf',function(){

			    	var refNo = $(this).attr("data-id");

			    	window.open("./invoice/Invoice_"+refNo+".pdf", "_blank");                                                                  

			    })

		})//document ends

