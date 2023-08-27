<?php

	session_start();

	include_once("auth.php");

	$user = new Auth();

	//Sign Up Starts
	if(isset($_POST['action']) && $_POST['action'] == "signUp")
	{
		$orgName = $user->test_input(strtoupper($_POST['orgName'])); 
		$username = $user->test_input($_POST['username']);
		$email = $user->test_input($_POST['email']);
		$phone = $user->test_input($_POST['phone']);
		$password = $user->test_input($_POST['password']);
		$hashedPassword = password_hash($password,PASSWORD_DEFAULT);

		//Check Availability of Organization Name
		if($user->checkAvailability($orgName))
		{
			echo "Exists";
		}
		else
		{
			//User Sign Up
			if($user->signUp($orgName,$username,$email,$phone,$hashedPassword))
			{
				echo "Success";
			}
			else
			{
				echo "BAD";
			}
		}


	}//Sign Up Ends

	//User Login Starts
	if(isset($_POST['action']) && $_POST['action'] == "userLogin")
	{
		$orgName = $user->test_input(strtoupper($_POST['orgName']));
		$userPassword = $user->test_input($_POST['userPassword']);

		$result = $user->userLogin($orgName);

		//If Organization Name Available
		if($result != null)
		{
			if(password_verify($userPassword, $result['password']))
			{
				$_SESSION['orgName'] = $orgName;
				echo "matching";
			}
			else
			{
				echo "notMatching";
			}
		}
		else
		{
			echo "notAvailable";
		}


	}//User Login Ends

	//Admin Login Starts
	if(isset($_POST['action']) && $_POST['action'] == "adminLogin")
	{
		$username = $user->test_input($_POST['username']);
		$adminPassword = $user->test_input($_POST['adminPassword']);
		$hashedAdminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

		$result = $user->adminLogin($username);

		if($result != null)
		{
			if(password_verify($adminPassword, $result['password']))
			{
				$_SESSION['adminUsername'] = $username;
				echo "adminMatching";
			}
			else
			{
				echo "adminNotMatching";
			}
		}
		else
		{
			echo "adminNotAvailable";
		}

	}

	//Fetch All Users
	if(isset($_POST['action']) && $_POST['action'] == "fetchAllUsers")
	{
			$result = $user->fetchAllUsers();

		    if($result != null)
		    {
		    	        $output = '';

					    $output .= ' <table id="usersTable">
								<thead>
                                    <tr>
                                        <th>#Org ID</th>
                                        <th>Organization Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Reg Date</th>
                                        <th>Business Reg No</th>
                                        <th>Province</th>
                                        <th>City</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

					    <tbody>';

					        foreach($result as $row)
						    {

						        $output .= '<tr>
						        <td>'.$row['org_id'].'</td>
						        <td>'.$row['org_name'].'</td>
						        <td>'.$row['username'].'</td>
						       	<td>'.$row['email'].'</td>
						        <td>'.$row['phone'].'</td>
						        <td>'.$row['address'].'</td>
						        <td>'.$row['reg_date'].'</td>
						        <td>'.$row['business_reg'].'</td>
						        <td>'.$row['province'].'</td>
						     	<td>'.$row['city'].'</td>';

						     	if($row['status'] == 1)
						     	{
						    		$output .= '<td><button type="button" class="btn btn-success updateUnavailableStatusBtn" data-id="'.$row['org_id'].'"><i class="fa fa-check-circle"></i>&nbsp Status</button></td>
						        	</tr>';
						     	}

						     	else
						     	{
						     		$output .= '<td><button type="button" class="btn btn-danger updateAvailableStatusBtn" data-id="'.$row['org_id'].'"><i class="fa fa-minus-circle"></i>&nbsp Status</button></td>
						        	</tr>';
						     	}

						        
						    }

						        $output .= '</tbody>
								    
								</table>';

								echo $output;

		    }
		    else
		    {
		    	echo "<h3 class='text-danger text-center'>No Users</h3>";
		    }
	}

	//Update to Unavailable Users
	if(isset($_POST['action']) && $_POST['action'] == "updateToUnavailableUser")
	{
		$orgID = $user->test_input($_POST['dataID']);

		if($user->updateToUnavailableUser($orgID))
		{
			echo "Success";
		}
		else
		{
			echo "Failed";
		}
	}

	//Update to Available Users
	if(isset($_POST['action']) && $_POST['action'] == "updateToAvailableUser")
	{
		$orgID = $user->test_input($_POST['dataID']);

		if($user->updateToAvailableUser($orgID))
		{
			echo "Success";
		}
		else
		{
			echo "Failed";
		}
	}


	//Settings Features Starts

	//Update to Unvailable Users

		//Change Admin Password
		if(isset($_POST['action']) && $_POST['action'] == "changeAdminPassword")
		{
			$oldPassword = $user->test_input($_POST['oldPassword']);
			$newPassword = $user->test_input($_POST['newPassword']);
			$username = $user->test_input($_POST['username']);

			$hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

			//Check the Old Password
			$result = $user->adminLogin($username);

					if($result != null)
					{
						if(password_verify($oldPassword, $result['password']))
						{
							$user->changeAdminPassword($hashedNewPassword,$username);
							echo "Success";
						}
						else
						{
							echo "oldPasswordNotMatching";
						}
					}

		}

		//Change User Password
		if(isset($_POST['action']) && $_POST['action'] == "changeUserPassword")
		{
			$oldPassword = $user->test_input($_POST['userOldPassword']);
			$newPassword = $user->test_input($_POST['userNewPassword']);
			$orgName = $user->test_input($_POST['orgName']);

			$hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

			//Check the Old Password
			$result = $user->userLogin($orgName);

					if($result != null)
					{
						if(password_verify($oldPassword, $result['password']))
						{
							$user->changeUserPassword($hashedNewPassword,$orgName);
							echo "Success";
						}
						else
						{
							echo "oldPasswordNotMatching";
						}
					}

		}

		//Change Details
		if(isset($_POST['action']) && $_POST['action'] == "changeDetails")
		{
			$orgName = $user->test_input($_POST['orgName']);
			$email = $user->test_input($_POST['email']);
			$phone = $user->test_input($_POST['phone']);
			$regDate = $user->test_input($_POST['regDate']);
			$bRegNo = $user->test_input($_POST['bRegNo']);
			$country = ucfirst($user->test_input($_POST['country']));
			$city = ucfirst($user->test_input($_POST['city']));
			$province = ucfirst($user->test_input($_POST['province']));

			if($user->changeUserDetails($orgName,$email,$phone,$regDate,$bRegNo,$country,$city,$province))
			{
				echo "Success";
			}
			else
			{
				echo "Failed";
			}

		}


	//Settings Features Ends




	//Inventory Features Starts

			//Fetch All Main Categories
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllMainCategories")
			{
					$orgID = $user->test_input($_POST['orgID']);

					$result = $user->fetchAllMainCategories($orgID);

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= ' <table id="mainCategoriesTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;">#Main Category ID</th>
                                        <th style="display: none;">#Org ID</th>
                                        <th>Main Category</th>
                                        <th>Date Added</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

							    <tbody>';

							        foreach($result as $row)
								    {

								        $output .= '<tr>
								        <td style="display: none;">'.$row['mcID'].'</td>
								        <td style="display: none;">'.$row['orgID'].'</td>
								        <td>'.$row['mcName'].'</td>
								        <td>'.$row['date_added'].'</td>
                                        <td><button type="button" class="btn btnEditMainCategory btn-warning" data-id="'.$row['mcID'].'" org-id"'.$row['orgID'].'"><i class="fa fa-edit"></i>&nbsp Edit</button></td>
                                        <td><button type="button" class="btn btnDeleteMainCategory btn-danger" data-id="'.$row['mcID'].'" org-id"'.$row['orgID'].'"><i class="fa fa-trash"></i>&nbsp Delete</button></td>';


                                       


								     	if($row['status'] == 1)
								     	{
								    		$output .= '<td><button type="button" class="btn btnUnavailableMainCategory btn-success" data-id="'.$row['mcID'].'" org-id"'.$row['orgID'].'"><i class="fa fa-check-circle"></i>&nbsp Status</button></td>
                                    		</tr>';
								     	}

								     	else
								     	{
								     		$output .= '<td><button type="button" class="btn btnAvailableMainCategory btn-danger" data-id="'.$row['mcID'].'" org-id"'.$row['orgID'].'"><i class="fa fa-minus-circle"></i>&nbsp Status</button></td>
                                    		</tr>';
								     	}

								        
								    }

								        $output .= '</tbody>
										    
										</table>';

										echo $output;

				    }
				    else
				    {
				    	echo "<h3 class='text-danger text-center'>No Main Categories Added</h3>";
				    }
			}

			//Update to Unavailable Main Categories
			if(isset($_POST['action']) && $_POST['action'] == "updateToUnavailableMainCategory")
			{
				$mcID = $user->test_input($_POST['dataID']);

				if($user->updateToUnavailableMainCategory($mcID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}
			}

			//Update to Available Main Categories
			if(isset($_POST['action']) && $_POST['action'] == "updateToAvailableMainCategory")
			{
				$mcID = $user->test_input($_POST['dataID']);

				if($user->updateToAvailableMainCategory($mcID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}
			}

			//Add Main Categories
			if(isset($_POST['action']) && $_POST['action'] == "addMainCategory")
			{
				$orgID = $user->test_input($_POST['orgID']);
				$mainCategory = ucfirst($user->test_input($_POST['mainCategory']));

				if($user->checkMainCategory($mainCategory,$orgID))
				{
					echo "Available";	
				}
				else
				{
					if($user->addMainCategory($mainCategory,$orgID))
					{
						echo "Success";
					}
					else
					{
						echo "failed";
					}
				}
			}

			//Delete Main Category
			if(isset($_POST['action']) && $_POST['action'] == "deleteMainCategory")
			{
				$mcID = $user->test_input($_POST['mcID']);

				if($user->deleteMainCategory($mcID))
				{
					echo "Success";	
				}
				else
				{
					echo "Failed";
				}
			}

			//Update Main Categories
			if(isset($_POST['action']) && $_POST['action'] == "updateMainCategory")
			{
				$mcID = $user->test_input($_POST['mcID']);
				$orgID = $user->test_input($_POST['orgID']);
				$mainCategory = ucfirst($user->test_input($_POST['mainCategory']));

				if($user->checkMainCategory($mainCategory,$orgID))
				{
					echo "Available";	
				}
				else
				{
					if($user->updateMainCategory($mcID,$mainCategory))
					{
						echo "Success";
					}
					else
					{
						echo "failed";
					}
				}
			}


			//Fetch All Sub Categories
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllSubCategories")
			{
					$orgID = $user->test_input($_POST['orgID']);

					$result = $user->fetchAllSubCategories($orgID);

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= ' <table id="subCategoriesTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;">#Sub Category ID</th>
                                        <th style="display: none;">#Main Category ID</th>
                                        <th style="display: none;">#Org ID</th>
                                        <th>Sub Category</th>
                                        <th>Main Category</th>
                                        <th>Date Added</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

							    <tbody>';

							        foreach($result as $row)
								    {

								        $output .= '<tr>
								        <td style="display: none;">'.$row['scID'].'</td>
								        <td style="display: none;">'.$row['mcID'].'</td>
								        <td style="display: none;">'.$row['org_id'].'</td>
								        <td>'.$row['scName'].'</td>
								        <td>'.$row['mcName'].'</td>
								        <td>'.$row['date_added'].'</td>
                                        <td><button type="button" class="btn btnEditSubCategory btn-warning" data-id="'.$row['scID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-edit"></i>&nbsp Edit</button></td>
                                        <td><button type="button" class="btn btnDeleteSubCategory btn-danger" data-id="'.$row['scID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-trash"></i>&nbsp Delete</button></td>';


                                       


								     	if($row['status'] == 1)
								     	{
								    		$output .= '<td><button type="button" class="btn btnUnavailableSubCategory btn-success" data-id="'.$row['scID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-check-circle"></i>&nbsp Status</button></td>
                                    		</tr>';
								     	}

								     	else
								     	{
								     		$output .= '<td><button type="button" class="btn btnAvailableSubCategory btn-danger" data-id="'.$row['scID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-minus-circle"></i>&nbsp Status</button></td>
                                    		</tr>';
								     	}

								        
								    }

								        $output .= '</tbody>
										    
										</table>';

										echo $output;

				    }
				    else
				    {
				    	echo "<h3 class='text-danger text-center'>No Sub Categories Added</h3>";
				    }
				    //select s.scID, s.org_id, s.mcID , s.scName, m.mcName, s.date_added, s.status  from sub_categories s, main_categories m  where s.mcID= m.mcID and s.org_id=1; used query
			}


			//Update to Unavailable Sub Categories
			if(isset($_POST['action']) && $_POST['action'] == "updateToUnavailableSubCategory")
			{
				$scID = $user->test_input($_POST['dataID']);

				if($user->updateToUnavailableSubCategory($scID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}
			}

			//Update to Available Sub Categories
			if(isset($_POST['action']) && $_POST['action'] == "updateToAvailableSubCategory")
			{
				$scID = $user->test_input($_POST['dataID']);

				if($user->updateToAvailableSubCategory($scID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}
			}

			//Fetch Main Categories For Dropdown
			if(isset($_POST['action']) && $_POST['action'] == "fetchMainCategoriesDropdown")
			{
				$orgID = $user->test_input($_POST['orgID']);

				$result = $user->fetchMainCategoriesDropdown($orgID);

				if($result!=null)
				{
					
					$output = '<select id="selectMainCategory" class="form-select form-select">
                              <option selected value="0">Select the Main Category</option>';

							foreach($result as $row)
							{

								$output .= '<option value="'.$row['mcID'].'">'.$row['mcName'].'</option>';
							}

					$output .= '</select>';

					echo $output;
							
				}
				else
				{
					echo $output = '<select id="selectMainCategory" class="form-select form-select-lg">
                         <option selected value="0">Select the Main Category</option>
                         </select>';
				}
			}

			//Add Sub Categories
			if(isset($_POST['action']) && $_POST['action'] == "addSubCategory")
			{
				$orgID = $user->test_input($_POST['orgID']);
				$mcID = $user->test_input($_POST['mcID']);
				$subCategory = ucfirst($user->test_input($_POST['subCategory']));

				if($user->checkSubCategory2($subCategory,$orgID))
				{
					echo "Available";	
				}
				else
				{
					if($user->addSubCategory($subCategory,$mcID,$orgID))
					{
						echo "Success";
					}
					else
					{
						echo "failed";
					}
				}
			}

			//Delete Sub Category
			if(isset($_POST['action']) && $_POST['action'] == "deleteSubCategory")
			{
				$scID = $user->test_input($_POST['scID']);

				if($user->deleteSubCategory($scID))
				{
					echo "Success";	
				}
				else
				{
					echo "Failed";
				}
			}

			//Update Sub Categories
			if(isset($_POST['action']) && $_POST['action'] == "updateSubCategory")
			{
				$mcID = $user->test_input($_POST['mcID']);
				$scID = $user->test_input($_POST['scID']);
				$orgID = $user->test_input($_POST['orgID']);
				$subCategory = ucfirst($user->test_input($_POST['subCategory']));

				if($user->checkSubCategory($subCategory,$orgID,$scID))
				{
					echo "Available";	
				}
				else
				{
					if($user->updateSubCategory($scID,$mcID,$subCategory))
					{
						echo "Success";
					}
					else
					{
						echo "failed";
					}
				}

			}

			//Fetch All Brands
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllBrands")
			{
					$orgID = $user->test_input($_POST['orgID']);

					$result = $user->fetchAllBrands($orgID);

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= ' <table id="brandsTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;">#Brand ID</th>
                                        <th style="display: none;">#Org ID</th>
                                        <th>Brand</th>
                                        <th>Date Added</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

							    <tbody>';

							        foreach($result as $row)
								    {

								        $output .= '<tr>
								        <td style="display: none;">'.$row['bID'].'</td>
								        <td style="display: none;">'.$row['org_id'].'</td>
								        <td>'.$row['bName'].'</td>
								        <td>'.$row['date_added'].'</td>
                                        <td><button type="button" class="btn btnEditBrand btn-warning" data-id="'.$row['bID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-edit"></i>&nbsp Edit</button></td>
                                        <td><button type="button" class="btn btnDeleteBrand btn-danger" data-id="'.$row['bID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-trash"></i>&nbsp Delete</button></td>';


                                       


								     	if($row['status'] == 1)
								     	{
								    		$output .= '<td><button type="button" class="btn btnUnavailableBrand btn-success" data-id="'.$row['bID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-check-circle"></i>&nbsp Status</button></td>
                                    		</tr>';
								     	}

								     	else
								     	{
								     		$output .= '<td><button type="button" class="btn btnAvailableBrand btn-danger" data-id="'.$row['bID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-minus-circle"></i>&nbsp Status</button></td>
                                    		</tr>';
								     	}

								        
								    }

								        $output .= '</tbody>
										    
										</table>';

										echo $output;

				    }
				    else
				    {
				    	echo "<h3 class='text-danger text-center'>No Brands Added</h3>";
				    }
			}

			//Update to Unavailable Brands
			if(isset($_POST['action']) && $_POST['action'] == "updateToUnavailableBrand")
			{
				$bID = $user->test_input($_POST['dataID']);

				if($user->updateToUnavailableBrand($bID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}
			}

			//Update to Available Brands
			if(isset($_POST['action']) && $_POST['action'] == "updateToAvailableBrand")
			{
				$bID = $user->test_input($_POST['dataID']);

				if($user->updateToAvailableBrand($bID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}
			}

			//Add Brands
			if(isset($_POST['action']) && $_POST['action'] == "addBrand")
			{
				$orgID = $user->test_input($_POST['orgID']);
				$brand = ucfirst($user->test_input($_POST['brand']));

				if($user->checkBrand($brand,$orgID))
				{
					echo "Available";	
				}
				else
				{
					if($user->addBrand($brand,$orgID))
					{
						echo "Success";
					}
					else
					{
						echo "failed";
					}
				}
			}

			//Delete Brand
			if(isset($_POST['action']) && $_POST['action'] == "deleteBrand")
			{
				$bID = $user->test_input($_POST['bID']);

				if($user->deleteBrand($bID))
				{
					echo "Success";	
				}
				else
				{
					echo "Failed";
				}
			}

			//Update Brands
			if(isset($_POST['action']) && $_POST['action'] == "updateBrand")
			{
				$bID = $user->test_input($_POST['bID']);
				$orgID = $user->test_input($_POST['orgID']);
				$brand = ucfirst($user->test_input($_POST['brand']));

				if($user->checkBrand($brand,$orgID))
				{
					echo "Available";	
				}
				else
				{
					if($user->updateBrand($bID,$brand))
					{
						echo "Success";
					}
					else
					{
						echo "failed";
					}
				}
			}

			//Fetch All Suppliers
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllSuppliers")
			{
					$orgID = $user->test_input($_POST['orgID']);

					$result = $user->fetchAllSuppliers($orgID);

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= ' <table id="suppliersTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;">#Supplier ID</th>
                                        <th style="display: none;">#Org ID</th>
                                        <th>Supplier Name</th>
                                        <th>Address</th>
                                        <th>Phone No</th>
                                        <th>Date Added</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

							    <tbody>';

							        foreach($result as $row)
								    {

								        $output .= '<tr>
								        <td style="display: none;">'.$row['sID'].'</td>
								        <td style="display: none;">'.$row['org_id'].'</td>
								        <td>'.$row['sName'].'</td>
								        <td>'.$row['sAddress'].'</td>
								        <td>'.$row['sPhone'].'</td>
								        <td>'.$row['date_added'].'</td>
                                        <td><button type="button" class="btn btnEditSupplier btn-warning" data-id="'.$row['sID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-edit"></i>&nbsp Edit</button></td>
                                        <td><button type="button" class="btn btnDeleteSupplier btn-danger" data-id="'.$row['sID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-trash"></i>&nbsp Delete</button></td>';


                                       


								     	if($row['status'] == 1)
								     	{
								    		$output .= '<td><button type="button" class="btn btnUnavailableSupplier btn-success" data-id="'.$row['sID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-check-circle"></i>&nbsp Status</button></td>
                                    		</tr>';
								     	}

								     	else
								     	{
								     		$output .= '<td><button type="button" class="btn btnAvailableSupplier btn-danger" data-id="'.$row['sID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-minus-circle"></i>&nbsp Status</button></td>
                                    		</tr>';
								     	}

								        
								    }

								        $output .= '</tbody>
										    
										</table>';

										echo $output;

				    }
				    else
				    {
				    	echo "<h3 class='text-danger text-center'>No Suppliers Added</h3>";
				    }
			}

			//Update to Unavailable Suppliers
			if(isset($_POST['action']) && $_POST['action'] == "updateToUnavailableSupplier")
			{
				$sID = $user->test_input($_POST['dataID']);

				if($user->updateToUnavailableSupplier($sID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}
			}

			//Update to Available Suppliers
			if(isset($_POST['action']) && $_POST['action'] == "updateToAvailableSupplier")
			{
				$sID = $user->test_input($_POST['dataID']);

				if($user->updateToAvailableSupplier($sID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}
			}

			//Add Suppliers
			if(isset($_POST['action']) && $_POST['action'] == "addSupplier")
			{
				$orgID = $user->test_input($_POST['orgID']);
				$supplierName = ucfirst($user->test_input($_POST['supplierName']));
				$supplierAddress = ucfirst($user->test_input($_POST['supplierAddress']));
				$supplierPhone = ucfirst($user->test_input($_POST['supplierPhone']));

					if($user->addSupplier($supplierName,$supplierAddress,$supplierPhone,$orgID))
					{
						echo "Success";
					}
					else
					{
						echo "failed";
					}
				
			}

			//Delete Suppliers
			if(isset($_POST['action']) && $_POST['action'] == "deleteSupplier")
			{
				$sID = $user->test_input($_POST['sID']);

				if($user->deleteSupplier($sID))
				{
					echo "Success";	
				}
				else
				{
					echo "Failed";
				}
			}

			//Update Suppliers
			if(isset($_POST['action']) && $_POST['action'] == "updateSupplier")
			{
				$sID = $user->test_input($_POST['sID']);
				$supplierName = ucfirst($user->test_input($_POST['supplierName']));
				$supplierAddress = ucfirst($user->test_input($_POST['supplierAddress']));
				$supplierPhone = ucfirst($user->test_input($_POST['supplierPhone']));

					if($user->updateSupplier($supplierName,$supplierAddress,$supplierPhone,$sID))
					{
						echo "Success";
					}
					else
					{
						echo "failed";
					}
				
			}

			//Fetch All Products
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllProducts")
			{
					$orgID = $user->test_input($_POST['orgID']);

					$result = $user->fetchAllProducts($orgID);

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= ' <table id="productsTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;">#Product ID</th>
                                        <th style="display: none;">#Sub Category ID</th>
                                        <th style="display: none;">#Brand ID</th>
                                        <th style="display: none;">#Supplier ID</th>
                                        <th style="display: none;">#Org ID</th>
                                        <th>Product</th>
                                        <th>Main Category</th>
                                        <th>Sub Category</th>
                                        <th>Brand</th>
                                        <th>Supplier</th>
                                        <th>Quantity</th>
                                        <th>Buy Price</th>
                                        <th>Sell Price</th>
                                        <th>Date Added</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

							    <tbody>';

							        foreach($result as $row)
								    {

								        $output .= '<tr>
								        <td style="display: none;">'.$row['pID'].'</td>
								        <td style="display: none;">'.$row['scID'].'</td>
								     	<td style="display: none;">'.$row['bID'].'</td>
								    	<td style="display: none;">'.$row['sID'].'</td>
								        <td style="display: none;">'.$row['org_id'].'</td>
								        <td>'.$row['pName'].'</td>
								        <td>'.$row['mcName'].'</td>
								       	<td>'.$row['scName'].'</td>
								      	<td>'.$row['bName'].'</td>
								       	<td>'.$row['sName'].'</td>
								      	<td>'.$row['qty'].'</td>
								      	<td>'.$row['buy_price'].'</td>
								       	<td>'.$row['sell_price'].'</td>
								        <td>'.$row['date_added'].'</td>
                                        <td><button type="button" class="btn btnEditProduct btn-warning" data-id="'.$row['pID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-edit"></i>&nbsp Edit</button></td>
                                        <td><button type="button" class="btn btnDeleteProduct btn-danger" data-id="'.$row['pID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-trash"></i>&nbsp Delete</button></td>';


                                       


								     	if($row['status'] == 1)
								     	{
								    		$output .= '<td><button type="button" class="btn btnUnavailableProduct btn-success" data-id="'.$row['pID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-check-circle"></i>&nbsp Status</button></td>
                                    		</tr>';
								     	}

								     	else
								     	{
								     		$output .= '<td><button type="button" class="btn btnAvailableProduct btn-danger" data-id="'.$row['pID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-minus-circle"></i>&nbsp Status</button></td>
                                    		</tr>';
								     	}

								        
								    }

								        $output .= '</tbody>
										    
										</table>';

										echo $output;

				    }
				    else
				    {
				    	echo "<h3 class='text-danger text-center'>No Products Added</h3>";
				    }
				    //select p.pID, p.pName, m.mcName, sc.scName , b.bName, s.sName , m.mcID, sc.scID , b.bID, s.sID , p.qty, p.buy_price, p.sell_price, p.org_id, p.date_added , p.status from products p , main_categories m , sub_categories sc, brands b , suppliers s where m.mcID = sc.mcID and p.scID = sc.scID and p.bID = b.bID and p.sID = s.sID and p.org_id = 1; used query
			}

			//Update to Unavailable Products
			if(isset($_POST['action']) && $_POST['action'] == "updateToUnavailableProduct")
			{
				$pID = $user->test_input($_POST['dataID']);

				if($user->updateToUnavailableProduct($pID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}
			}

			//Update to Available Products
			if(isset($_POST['action']) && $_POST['action'] == "updateToAvailableProduct")
			{
				$pID = $user->test_input($_POST['dataID']);

				if($user->updateToAvailableProduct($pID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}
			}

			//Fetch Sub Categories For Dropdown
			if(isset($_POST['action']) && $_POST['action'] == "fetchSubCategoriesDropdown")
			{
				$orgID = $user->test_input($_POST['orgID']);

				$result = $user->fetchSubCategoriesDropdown($orgID);

				if($result!=null)
				{
					
					$output = '<select id="selectSubCategory" class="form-select">
                              <option selected value="0">Select the Sub Category</option>';

							foreach($result as $row)
							{

								$output .= '<option value="'.$row['scID'].'">'.$row['scName'].'</option>';
							}

					$output .= '</select>';

					echo $output;
							
				}
				else
				{
					echo $output = '<select id="selectSubCategory" class="form-select">
                    <option selected value="0">Select the Sub Category</option>
                    </select>';
				}
			}

			//Fetch Brands For Dropdown
			if(isset($_POST['action']) && $_POST['action'] == "fetchBrandsDropdown")
			{
				$orgID = $user->test_input($_POST['orgID']);

				$result = $user->fetchBrandsDropdown($orgID);

				if($result!=null)
				{
					
					$output = '<select id="selectBrand" class="form-select">
                              <option selected value="0">Select the Brand</option>';

							foreach($result as $row)
							{

								$output .= '<option value="'.$row['bID'].'">'.$row['bName'].'</option>';
							}

					$output .= '</select>';

					echo $output;
							
				}
				else
				{
					echo '<select id="selectBrand" class="form-select">
                              <option selected value="0">Select the Brand</option>
                          </select>';
				}
			}

			//Fetch Suppliers For Dropdown
			if(isset($_POST['action']) && $_POST['action'] == "fetchSuppliersDropdown")
			{
				$orgID = $user->test_input($_POST['orgID']);

				$result = $user->fetchSuppliersDropdown($orgID);

				if($result!=null)
				{
					
					$output = '<select id="selectSupplier" class="form-select">
                              <option selected value="0">Select the Supplier</option>';

							foreach($result as $row)
							{

								$output .= '<option value="'.$row['sID'].'">'.$row['sName'].'</option>';
							}

					$output .= '</select>';

					echo $output;
							
				}
				else
				{
					echo $output = '<select id="selectSupplier" class="form-select">
                              <option selected value="0">Select the Supplier</option>
                              </select>';
				}
			}

			//Add Products
			if(isset($_POST['action']) && $_POST['action'] == "addProduct")
			{
				$orgID = $user->test_input($_POST['orgID']);
				$product = ucfirst($user->test_input($_POST['product']));
				$scID = ucfirst($user->test_input($_POST['scID']));
				$bID = ucfirst($user->test_input($_POST['bID']));
				$sID = ucfirst($user->test_input($_POST['sID']));
				$qty = ucfirst($user->test_input($_POST['qty']));
				$date = ucfirst($user->test_input($_POST['date']));
				$buyPrice = ucfirst($user->test_input($_POST['buyPrice']));
				$sellPrice = ucfirst($user->test_input($_POST['sellPrice']));


				if($user->checkProduct2($product,$orgID))
				{
					echo "Available";	
					//insert into price_history (pID,price,org_id,status) values (NEW.pID, NEW.sell_price,NEW.org_id,1); used trigger
				}
				else
				{
					if($user->addProduct($product,$scID,$bID,$sID,$qty,$date,$buyPrice,$sellPrice,$orgID))
					{
						echo "Success";
					}
					else
					{
						echo "failed";
					}
				}
				
			}

			//Delete Products
			if(isset($_POST['action']) && $_POST['action'] == "deleteProduct")
			{
				$pID = $user->test_input($_POST['pID']);

				if($user->deleteProduct($pID))
				{
					echo "Success";	
				}
				else
				{
					echo "Failed";
				}
			}

			//Update Products
			if(isset($_POST['action']) && $_POST['action'] == "updateProduct")
			{
				$pID = $user->test_input($_POST['pID']);
				$orgID = $user->test_input($_POST['orgID']);
				$product = ucfirst($user->test_input($_POST['product']));
				$scID = ucfirst($user->test_input($_POST['scID']));
				$bID = ucfirst($user->test_input($_POST['bID']));
				$sID = ucfirst($user->test_input($_POST['sID']));
				$qty = ucfirst($user->test_input($_POST['qty']));
				$date = ucfirst($user->test_input($_POST['date']));
				$buyPrice = ucfirst($user->test_input($_POST['buyPrice']));
				$sellPrice = ucfirst($user->test_input($_POST['sellPrice']));


				if($user->checkProduct($product,$orgID,$pID))
				{
					echo "Available";	
				}
				else
				{
					if($user->updateProduct($product,$scID,$bID,$sID,$qty,$date,$buyPrice,$sellPrice,$pID))
					{
						if($user->productSellPrice($pID) != $sellPrice)
						{
							$user->updateProductPriceHistory($pID,$orgID,$sellPrice);
						}

						echo "Success";
					}
					else
					{
						echo "failed";
					}
				}
				
			}

	//Inventory Features Ends


	

	//Billing Features Starts

			//Assign Bill Ref No
			if(isset($_POST['action']) && $_POST['action'] == "assignBillRefNo")
			{
				$orgID = $user->test_input($_POST['orgID']);

				if($user->assignBillRefNo($orgID))
				{
					$result = $user->finallyAddedRefNo($orgID);
					echo $result['refNo'];
				}

			}

			//Fetch All Products For Billing Dropdown
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllProductsForBillingDropdown")
			{
				$orgID = $user->test_input($_POST['orgID']);

				$result = $user->fetchAllProducts2($orgID);

				if($result != null)
				{
					$output = '<select id="selectBillProduct" class="form-select form-select">
                              <option selected value="0">Select the Product</option>';

							foreach($result as $row)
							{

								$output .= '<option value="'.$row['pID'].'">'.$row['pName'].'</option>';
							}

					$output .= '</select> <p class="text-danger billProduct_error fw-bold text-start"></p>';

					echo $output;
							
				}
				else
				{
					echo $output = '<select id="selectBillProduct" class="form-select form-select">
                              <option selected value="0">Select the Product</option>
                              </select> <p class="text-danger billProduct_error fw-bold text-start"></p>';
				}

			}
			
			//Fetch Products Available Quantity
			if(isset($_POST['action']) && $_POST['action'] == "fetchProductsAvailableQuantity")
			{
				$pID = $user->test_input($_POST['pID']);

				$result = $user->fetchProductsAvailableDetails($pID);

				if($result)
				{
					echo $result['qty'];
				}
				else
				{
					echo "0";
				}

			}

			//Fetch Products Price
			if(isset($_POST['action']) && $_POST['action'] == "fetchProductsPrice")
			{
				$pID = $user->test_input($_POST['pID']);

				$result = $user->fetchProductsAvailableDetails($pID);

				if($result)
				{
					echo $result['sell_price'];
				}
				else
				{
					echo "0.00";
				}
			}

			//Add Bill Product
			if(isset($_POST['action']) && $_POST['action'] == "addBillProduct")
			{
				$pID = $user->test_input($_POST['pID']);
				$orgID = $user->test_input($_POST['orgID']);
				$refNo = $user->test_input($_POST['refNo']);
				$qty = $user->test_input($_POST['qty']);
				$price = $user->test_input($_POST['price']);
				$pTotal = $user->test_input($_POST['pTotal']);
				$billDate = $user->test_input($_POST['billDate']);

				if($user->addBillProduct($refNo,$pID,$qty,$price,$pTotal,$billDate))
				{
					if($user->reduceProductQuantity($pID,$qty))
					{
						echo "Success";
					}
				}


			}

			//Fetch All Products
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllBilledProducts")
			{
					$refNo = $user->test_input($_POST['refNo']);

					$result = $user->fetchAllBilledProducts($refNo);

					$i = 0;

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= ' <table class="table" style="width:100%;">
							                <thead>
							                  <tr>
							                  	<th scope="col" style="display: none;">#bpID</th>
							                    <th scope="col">#No</th>
							                    <th scope="col" style="display: none;">Product ID</th>
							                    <th scope="col">Product</th>
							                    <th scope="col">Quantity</th>
							                    <th scope="col">Price</th>
							                    <th scope="col">Total</th>
							                    <th scope="col">Remove</th>
							                  </tr>
							                </thead>
							                <tbody class="table-group-divider">';

							        foreach($result as $row)
								    {
								    	$i = $i+1;

								        $output .= '<tr>
								        <td style="display: none;">'.$row['bpID'].'</td>
								        <th>'.$i.'</th>
								        <td style="display: none;">'.$row['pID'].'</td>
					                    <td>'.$row['pName'].'</td>
					                    <td>'.$row['qty'].'</td>
					                    <td>'.$row['selled_price'].'</td>
					                    <td>'.$row['total'].'</td>
					                    <td><button type="button" class="btn btnDeleteBillProduct btn-danger" data-id="'.$row['bpID'].'"><i class="fa fa-trash"></i>&nbsp Remove</button></td>
                                        </tr>';
							        
								    }

			/*<td><button type="button" class="btn btnEditBillProduct btn-warning" data-id="'.$row['bpID'].'"><i class="fa fa-edit"></i>&nbsp Edit</button></td>*/

								        $output .= '</tbody>
										    
										</table>';

										echo $output;

				    }
				    else
				    {
				    	echo "<h3 class='text-danger text-center'>No Products Added</h3>";
				    }
			}

			//Fetch Sub Total
			if(isset($_POST['action']) && $_POST['action'] == "fetchSubTotal")
			{
				$refNo = $user->test_input($_POST['refNo']);

				$result = $user->fetchSubTotal($refNo);

				echo $result['sumTotal'];
			}

			//Remove Bill Product
			if(isset($_POST['action']) && $_POST['action'] == "removeBillProduct")
			{
				$bpID = $user->test_input($_POST['bpID']);
				$qty = $user->test_input($_POST['qty']);
				$pID = $user->test_input($_POST['pID']);

				if($user->removeBillProduct($bpID))
				{
					if($user->increaseProductQuantity($pID,$qty))
					{
						echo "Success";
					}
				}
				else
				{
					echo "Failed";
				}
				
			}

			//Finish Order
			if(isset($_POST['action']) && $_POST['action'] == "finishOrder")
			{
				$refNo = $user->test_input($_POST['refNo']);
				$billDate = $user->test_input($_POST['billDate']);
				$cusName = ucfirst($user->test_input($_POST['cusName']));
				$subTotal = $user->test_input($_POST['subTotal']);
				$discount = $user->test_input($_POST['discount']);
				$serviceCharge = $user->test_input($_POST['serviceCharge']);
				$total = $user->test_input($_POST['total']);

				if($user->updateBill($refNo,$billDate,$cusName,$subTotal,$discount,$serviceCharge,$total))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}
				
			}


	//Billing Features Ends




	//Reporting Features Starts

			//Fetch All Product Price History
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllProductPriceHistory")
			{
					$orgID = $user->test_input($_POST['orgID']);

					$result = $user->fetchAllProductPriceHistory($orgID);

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= ' <table id="historyOfProductPriceTable">
                                      <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

							        foreach($result as $row)
								    {
								        $output .= '<tr>
									        <td>'.$row['pName'].'</td>
									        <td>'.$row['price'].'</td>
									       	<td>'.$row['date'].'</td>
                                        </tr>';                              
                                    		
								    }
								    	$output .= '</tbody>
										    
										</table>';

										echo $output;
					        
					}
					else
					{
						echo "<h3 class='text-danger text-center'>No Data</h3>";
					}
				  
			}

			//Fetch All Transactions History
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllTransactionsHistory")
			{
					$orgID = $user->test_input($_POST['orgID']);

					$result = $user->fetchAllTransactionsHistory($orgID);

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= ' <table id="historyOfTransactionsTable">
                                      <thead>
                                        <tr>
                                            <th>#Reference No</th>
                                            <th>Customer Name</th>
                                            <th>Date</th>
                                            <th>Sub Total</th>
                                            <th>Discount</th>
                                            <th>Service Charge</th>
                                            <th>Total</th>
                                            <th>View Bill</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

							        foreach($result as $row)
								    {
								        $output .= '<tr>
									        <td>'.$row['refNo'].'</td>
									        <td>'.$row['cusName'].'</td>
									       	<td>'.$row['date'].'</td>
									       	<td>'.$row['sub_total'].'</td>
									        <td>'.$row['discount'].'</td>
									       	<td>'.$row['service_charge'].'</td>
									      	<td>'.$row['total'].'</td>
									      	<td><button class="btn btn-secondary viewPdf" data-id='.$row['refNo'].'><i class="fas fa-file-pdf"></i></td>
                                        </tr>';                              
                                    		
								    }
								    	$output .= '</tbody>
										    
										</table>';

										echo $output;
					        
					}
					else
					{
						echo "<h3 class='text-danger text-center'>No Data</h3>";
					}
				  
			}


			//Fetch All Sales History
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllSalesHistory")
			{
					$orgID = $user->test_input($_POST['orgID']);

					$result = $user->fetchAllSalesHistory($orgID);

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= ' <table id="historyOfSalesTable">
                                      <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Number of Items</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

							        foreach($result as $row)
								    {
								        $output .= '<tr>
									        <td>'.$row['pName'].'</td>
									        <td>'.$row['Number_Of_Items'].'</td>
                                        </tr>';                              
                                    		
								    }
								    	$output .= '</tbody>
										    
										</table>';

										echo $output;
					        
					}
					else
					{
						echo "<h3 class='text-danger text-center'>No Data</h3>";
					}
				  
			}

			//Fetch Top Selling Items
			if(isset($_POST['action']) && $_POST['action'] == "fetchTopSellingItems")
			{
					$orgID = $user->test_input($_POST['orgID']);

					$result = $user->fetchTopSellingItems($orgID);

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= '<ul class="list-group mt-3">';

							        foreach($result as $row)
								    {
								        $output .= '  <li class="list-group-item d-flex justify-content-between align-items-center">
								                        '.$row['pName'].'
								                        <span class="badge bg-primary rounded-pill">'.$row['Number_Of_Items'].'</span>
								                      </li>';                              
                                    		
								    }
								    	$output .= '</ul>';

										echo $output;
					        
					}
					else
					{
						echo "<ul class='list-group mt-3'>
								<li class='list-group-item d-flex justify-content-center align-items-center'> 
									<h3 class='text-danger text-center'>
										No Data
									</h3>
								</li>
							</ul>
						";
					}
				  
			}

	//Reporting Features Ends




	//Notifications Features Starts

			//Send Feedback To Admin By User
			if(isset($_POST['action']) && $_POST['action'] == "addUserFeedback")
			{
				$feedback = $user->test_input($_POST['feedback']);
				$orgID = $user->test_input($_POST['orgID']);

				if($user->addUserFeedback($feedback,$orgID))
				{
					echo "Success";
				}
				else
				{
					echo "<h3 class='text-danger text-center'>No Feedbacks</h3>";
				}

			}

			//Fetch All User Sended Feedbacks
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllUserSendedFeedbacks")
			{
					$orgID = $user->test_input($_POST['orgID']);

					$result = $user->fetchAllUserSendedFeedbacks($orgID);

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= ' <table id="sendedFeedbacksTable">
                                <thead>
                                    <tr>
                                            <th style="display: none;">#Feedback ID</th>
                                            <th>Feedback</th>
                                            <th>Time</th>
                                            <th>Delete</th>
                                    </tr>
                                </thead>

							    <tbody>';

							        foreach($result as $row)
								    {

								        $output .= '<tr>
								        <td style="display: none;">'.$row['nID'].'</td>
								        <td>'.$row['content'].'</td>
								        <td>'.$row['date'].'</td>
                                        <td><button type="button" class="btn btnDeleteUserFeedback btn-danger" data-id="'.$row['nID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-trash"></i>&nbsp Delete</button></td> 
                                        </tr>';

								        
								    }

								        $output .= '</tbody>
										    
										</table>';

										echo $output;
										

				    }
				    else
				    {
				    	echo "<h3 class='text-danger text-center'>No Feedbacks</h3>";
				    }
			}

			//Fetch All Admin Panel Feedbacks
			if(isset($_POST['action']) && $_POST['action'] == "fetchAllAdminPanelFeedbacks")
			{

					$result = $user->fetchAllAdminPanelFeedbacks();

				    if($result != null)
				    {
				    	        $output = '';

							    $output .= ' <table id="adminFeedbacksTable">
                                <thead>
                                    <tr>
                                          <th style="display: none;">#Feedback ID</th>
                                          <th style="display: none;">#Org ID</th>
                                          <th>Organization Name</th>
                                          <th>Feedback</th>
                                          <th>Time</th>
                                          <th>Reply</th>
                                    </tr>
                                </thead>

							    <tbody>';

							        foreach($result as $row)
								    {

								        $output .= '<tr>
								        <td style="display: none;">'.$row['nID'].'</td>
								        <td style="display: none;">'.$row['org_id'].'</td>
								        <td>'.$row['org_name'].'</td>
								        <td>'.$row['content'].'</td>
								        <td>'.$row['date'].'</td>
								        <td><button type="button" class="btn btnReplyFeedback btn-success" data-id="'.$row['nID'].'" org-id"'.$row['org_id'].'"><i class="fa fa-reply"></i>&nbsp Reply</button></td> 
                                        </tr>';

								        
								    }

								        $output .= '</tbody>
										    
										</table>';

										echo $output;
										

				    }
				    else
				    {
				    	echo "<h3 class='text-danger text-center'>No Feedbacks</h3>";
				    }
			}

			//Send Reply Feedback
			if(isset($_POST['action']) && $_POST['action'] == "sendReplyFeedback")
			{
				$replyFeedback = $user->test_input($_POST['replyFeedback']);
				$orgID = $user->test_input($_POST['orgID']);

				if($user->addReplyFeedback($replyFeedback,$orgID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}

			}

			//Delete User Feedback
			if(isset($_POST['action']) && $_POST['action'] == "deleteUserFeedback")
			{
				$nID = $user->test_input($_POST['nID']);

				if($user->deleteUserFeedback($nID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}

			}

			//Fetch User Notifications
			if(isset($_POST['action']) && $_POST['action'] == "fetchUserNotifications")
			{
				$orgID = $user->test_input($_POST['orgID']);

				$result = $user->fetchUserNotifications($orgID);

				if($result != null)
				{
					$i = 0;
					foreach($result as $row)
					{
						$i++;
						echo $user->showMessage("success",$row['content'],"Reply From Admin",$row['nID'],$user->timeInAgo($row['date']));
							

					}
					/*echo '<input type="text" id="replyNotificationCount" value="'.$i.'" style="display: none;">';*/
				}
				else
				{
					echo "<h3 class='text-danger text-center'>No Notifications</h3>";
				}

			}

			//Close Notifications
			if(isset($_POST['action']) && $_POST['action'] == "closeNotifications")
			{
				$nID = $user->test_input($_POST['nID']);

				if($user->closeUserNotifications($nID))
				{
					echo "Success";
				}
				else
				{
					echo "Failed";
				}

			}

			//Product Alert Notifications
			if(isset($_POST['action']) && $_POST['action'] == "fetchProductAlertNotifications")
			{
				$orgID = $user->test_input($_POST['orgID']);

				$result = $user->fetchAllProducts($orgID);

				if($result != null)
				{
					$i = 0;
					foreach($result as $row)
					{
						if($row['qty']<10)
						{
							echo $user->showMessage2("danger",$row['pName']." 's Quantity is ".$row['qty'],"Product Quantity is Low");
							$i++;
						}							

					}
					/*echo '<input type="text" id="productAlertNotificationCount" value="'.$i.'" style="display: none;">';*/
				}
				else
				{
					echo "<h3 class='text-danger text-center'>No Product Notifications</h3>";
				}

			}

			//Set Notification Alert
			if(isset($_POST['action']) && $_POST['action'] == "setNotificationAlert")
			{
				$orgID = $user->test_input($_POST['orgID']);

				$productAlert = $user->fetchAllProducts($orgID);
				$replyAlert = $user->fetchUserNotifications($orgID);
				
				$status = 0;

					if($productAlert != null)
					{
						foreach($productAlert as $row)
						{
							if($row['qty']<10)
							{
								$status = 1;
							}							

						}
					}

					if($replyAlert != null)
					{
							$status = 1;		
					}

					echo $status;
					
			}

			//Fetch Admin Notifications
			if(isset($_POST['action']) && $_POST['action'] == "fetchAdminNotifications")
			{
				$result = $user->fetchAdminNotifications();

				if($result != null)
				{
					foreach($result as $row)
					{
						echo $user->showMessage("success",$row['content'],"Feedback from ".$row['org_name'],$row['nID'],$user->timeInAgo($row['date']));
					}
				}
				else
				{
					echo "<h3 class='text-danger text-center'>No Notifications</h3>";
				}

			}

			//Set Admin Notification Alert
			if(isset($_POST['action']) && $_POST['action'] == "setAdminNotificationAlert")
			{
				
				$adminAlert = $user->fetchAllAdminPanelFeedbacks2();
				
				$status = 0;

					if($adminAlert != null)
					{
							$status = 1;		
					}

					echo $status;
					
			}

	//Notifications Features Ends

	


?>