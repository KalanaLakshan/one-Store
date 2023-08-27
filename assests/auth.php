<?php

	include_once("config.php");

	class Auth extends Database{

		//Sign Up user
		public function signUp($orgName,$username,$email,$phone,$password)
		{
			$sql = "insert into users(org_name,username,email,phone,password) values(:org_name,:username,:email,:phone,:password)";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['org_name'=>$orgName,'username'=>$username,'email'=>$email,'phone'=>$phone,'password'=>$password]);

			return true;
		}

		//Check availability of Organization
		public function checkAvailability($orgName)
		{
	        $sql = "select * from users where org_name=:org_name";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['org_name'=> $orgName]);
	        $result = $stmt->fetch(PDO::FETCH_ASSOC);

	        return $result;
		}

		//User Login
		public function userLogin($orgName)
		{
			$sql = "select * from users where org_name=:org_name and status=1";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['org_name'=>$orgName]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}

		//Check availability of Admin Username
		public function adminLogin($username)
		{
			$sql = "select * from admin where username=:username";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['username'=>$username]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}

		//Current organization details fetch
		public function currentOrganizationDetails($orgName)
		{
			$sql = "select * from users where org_name=:org_name";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['org_name'=>$orgName]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}

		//Fetch All Users
	    public function fetchAllUsers()
	    {
	        $sql = "select * from users";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute();
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	    //Update to Unvailable Users
	    public function updateToUnavailableUser($orgID)
		{
			$sql = "update users set status=0 where org_id=:org_id";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['org_id'=>$orgID]);

			return true;
		}

		//Update to Available Users
	    public function updateToAvailableUser($orgID)
		{
			$sql = "update users set status=1 where org_id=:org_id";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['org_id'=>$orgID]);

			return true;
		}



	//Settings Features Starts

		//Change Admin Password
	    public function changeAdminPassword($newPassword,$username)
		{
			$sql = "update admin set password=:password where username=:username";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['password'=>$newPassword,'username'=>$username]);

			return true;
		}

		//Change User Password
	    public function changeUserPassword($newPassword,$orgName)
		{
			$sql = "update users set password=:password where org_name=:org_name";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['password'=>$newPassword,'org_name'=>$orgName]);

			return true;
		}


		//Change Details
		public function changeUserDetails($orgName,$email,$phone,$regDate,$bRegNo,$country,$city,$province)
		{
			//update users set city="Badulla",email="ilharulhasan456@gmail.com" where org_name="XYZ COMPANY";
			$sql = "update users set email=:email,phone=:phone, reg_date=:regDate, business_reg=:bRegNo , country=:country , city=:city , province=:province  where org_name=:org_name";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['org_name'=>$orgName,'email'=>$email,'phone'=>$phone,'regDate'=>$regDate,'bRegNo'=>$bRegNo,'country'=>$country,'city'=>$city,'province'=>$province]);

			return true;
		}

	//Settings Features Ends




	//Inventory Features Starts

		//Fetch All Main Categories
	    public function fetchAllMainCategories($orgID)
	    {
	        $sql = "select * from main_categories where orgID=:orgID and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	   //Update to Unavilable Main Categories
	    public function updateToUnavailableMainCategory($mcID)
		{
			$sql = "update main_categories set status=0 where mcID=:mcID";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['mcID'=>$mcID]);

			return true;
		}

		//Update to Avilable Main Categories
	    public function updateToAvailableMainCategory($mcID)
		{
			$sql = "update main_categories set status=1 where mcID=:mcID";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['mcID'=>$mcID]);

			return true;
		}

		//Check the Availability of Main Category
		public function checkMainCategory($mainCategory,$orgID)
		{
			$sql = "select * from main_categories where mcName=:mcName and orgID=:orgID and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['mcName'=>$mainCategory,'orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
		}

		//Add Main Category
	    public function addMainCategory($mainCategory,$orgID)
	    {
	        $sql = "insert into main_categories(mcName,orgID,status) values(:mcName,:orgID,1)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['mcName'=>$mainCategory, 'orgID'=>$orgID]);

	        return true;
	    }

	    //Delete Main Category
	    public function deleteMainCategory($mcID)
	    {
	    	$sql = "update main_categories set is_deleted=1 where mcID=:mcID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['mcID'=>$mcID]);

	        return true;
	    }

	    //Update Main Category
	    public function updateMainCategory($mcID,$mainCategory)
	    {
	    	$sql = "update main_categories set mcName=:mcName where mcID=:mcID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['mcID'=>$mcID,'mcName'=>$mainCategory]);

	        return true;
	    }


	   	//Fetch All Sub Categories
		public function fetchAllSubCategories($orgID)
		{
			$sql = "select s.scID, s.org_id, s.mcID , s.scName, m.mcName, s.date_added, s.status  from sub_categories s, main_categories m  where s.mcID= m.mcID and s.org_id=:orgID and s.is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
		}

		//Update to Unavilable Sub Categories 
	    public function updateToUnavailableSubCategory($scID)
		{
			$sql = "update sub_categories set status=0 where scID=:scID";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['scID'=>$scID]);

			return true;
		}

		//Update to Avilable Sub Categories
	    public function updateToAvailableSubCategory($scID)
		{
			$sql = "update sub_categories set status=1 where scID=:scID";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['scID'=>$scID]);

			return true;
		}

		//Fetch Main Categories For Dropdown
		public function fetchMainCategoriesDropdown($orgID)
		{
			$sql = "select * from main_categories where orgID=:orgID and status=1 and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
		}

		//Check the Availability of Sub Category
		public function checkSubCategory($subCategory,$orgID,$scID)
		{
			$sql = "select * from sub_categories where (scName=:scName and org_id=:orgID) and scID!=:scID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['scName'=>$subCategory,'orgID'=>$orgID,'scID'=>$scID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
		}

		//Check the Availability of Sub Category
		public function checkSubCategory2($subCategory,$orgID)
		{
			$sql = "select * from sub_categories where (scName=:scName and org_id=:orgID and is_deleted=0)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['scName'=>$subCategory,'orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
		}

		//Add Sub Category
	    public function addSubCategory($subCategory,$mcID,$orgID)
	    {
	        $sql = "insert into sub_categories(scName,mcID,org_id,status) values(:scName,:mcID,:orgID,1)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['scName'=>$subCategory, 'orgID'=>$orgID,'mcID'=>$mcID]);

	        return true;
	    }

	    //Delete Sun Category
	    public function deleteSubCategory($scID)
	    {
	    	$sql = "update sub_categories set is_deleted=1 where scID=:scID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['scID'=>$scID]);

	        return true;
	    }

	    //Update Sub Category
	    public function updateSubCategory($scID,$mcID,$subCategory)
	    {
	    	$sql = "update sub_categories set scName=:scName, mcID=:mcID where scID=:scID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['mcID'=>$mcID,'scName'=>$subCategory,'scID'=>$scID]);

	        return true;
	    }

	   	//Fetch All Brands
	    public function fetchAllBrands($orgID)
	    {
	        $sql = "select * from brands where org_id=:orgID and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	    //Update to Unavailable Brands
	    public function updateToUnavailableBrand($bID)
		{
			$sql = "update brands set status=0 where bID=:bID";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['bID'=>$bID]);

			return true;
		}

		//Update to Available Brands
	    public function updateToAvailableBrand($bID)
		{
			$sql = "update brands set status=1 where bID=:bID";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['bID'=>$bID]);

			return true;
		}

		//Check the Availability of Brand
		public function checkBrand($brand,$orgID)
		{
			$sql = "select * from brands where bName=:bName and org_id=:orgID and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['bName'=>$brand,'orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
		}

		//Add Main Category
	    public function addBrand($brand,$orgID)
	    {
	        $sql = "insert into brands(bName,org_id,status) values(:bName,:org_id,1)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['bName'=>$brand, 'org_id'=>$orgID]);

	        return true;
	    }

	    //Delete Brand
	    public function deleteBrand($bID)
	    {
	    	$sql = "update brands set is_deleted=1 where bID=:bID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['bID'=>$bID]);

	        return true;
	    }

	    //Update Brand
	    public function updateBrand($bID,$brand)
	    {
	    	$sql = "update brands set bName=:bName where bID=:bID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['bID'=>$bID,'bName'=>$brand]);

	        return true;
	    }

	    //Fetch All Suppliers
	    public function fetchAllSuppliers($orgID)
	    {
	        $sql = "select * from suppliers where org_id=:orgID and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	    //Update to Unavailable Suppliers
	    public function updateToUnavailableSupplier($sID)
		{
			$sql = "update suppliers set status=0 where sID=:sID";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['sID'=>$sID]);

			return true;
		}

		//Update to Available Suppliers
	    public function updateToAvailableSupplier($sID)
		{
			$sql = "update suppliers set status=1 where sID=:sID";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['sID'=>$sID]);

			return true;
		}

		//Add Suppliers
	    public function addSupplier($supplierName,$supplierAddress,$supplierPhone,$orgID)
	    {
	        $sql = "insert into suppliers(sName,sAddress,sPhone,org_id,status) values(:sName,:sAddress,:sPhone,:org_id,1)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['sName'=>$supplierName, 'sAddress'=>$supplierAddress, 'sPhone'=>$supplierPhone, 'org_id'=>$orgID]);

	        return true;
	    }

	    //Delete Brand
	    public function deleteSupplier($sID)
	    {
	    	$sql = "update suppliers set is_deleted=1 where sID=:sID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['sID'=>$sID]);

	        return true;
	    }

	    //Update Supplier
	    public function updateSupplier($supplierName,$supplierAddress,$supplierPhone,$sID)
	    {
	    	$sql = "update suppliers set sName=:sName, sAddress=:sAddress, sPhone=:sPhone where sID=:sID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['sID'=>$sID,'sName'=>$supplierName,'sAddress'=>$supplierAddress,'sPhone'=>$supplierPhone]);

	        return true;
	    }

	   	//Fetch All Products
	    public function fetchAllProducts($orgID)
	    {
	        $sql = "select p.pID, p.pName, m.mcName, sc.scName , b.bName, s.sName , m.mcID, sc.scID , b.bID, s.sID , p.qty, p.buy_price, p.sell_price, p.org_id, p.date_added , p.status from products p , main_categories m , sub_categories sc, brands b , suppliers s where m.mcID = sc.mcID and p.scID = sc.scID and p.bID = b.bID and p.sID = s.sID and p.org_id =:orgID and p.is_deleted=0;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	    //Update to Unavailable Products
	    public function updateToUnavailableProduct($pID)
		{
			$sql = "update products set status=0 where pID=:pID";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['pID'=>$pID]);

			return true;
		}

		//Update to Available Products
	    public function updateToAvailableProduct($pID)
		{
			$sql = "update products set status=1 where pID=:pID";
			$stmt = $this->connection->prepare($sql);
			$stmt->execute(['pID'=>$pID]);

			return true;
		}

		//Fetch Sub Categories For Dropdown
		public function fetchSubCategoriesDropdown($orgID)
		{
			$sql = "select * from sub_categories where org_id=:orgID and status=1 and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
		}

		//Fetch Brands For Dropdown
		public function fetchBrandsDropdown($orgID)
		{
			$sql = "select * from brands where org_id=:orgID and status=1 and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
		}

		//Fetch Suppliers For Dropdown
		public function fetchSuppliersDropdown($orgID)
		{
			$sql = "select * from suppliers where org_id=:orgID and status=1 and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
		}

		//Add Products
	    public function addProduct($product,$scID,$bID,$sID,$qty,$date,$buyPrice,$sellPrice,$orgID)
	    {
	        $sql = "insert into products(pName,scID,bID,sID,qty,buy_price,sell_price,org_id,date_added,status) values(:pName,:scID,:bID,:sID,:qty,:buy_price,:sell_price,:org_id,:date_added,1)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['pName'=>$product, 'scID'=>$scID, 'bID'=>$bID,'sID'=>$sID,'qty'=>$qty,'date_added'=>$date,'buy_price'=>$buyPrice, 'sell_price'=>$sellPrice,'org_id'=>$orgID ]);

	        return true;
	        //insert into products(pName,scID,bID,sID,qty,buy_price,sell_price,org_id,date_added,status) values("I Phone 7+",14,1,1,10,120000,135000,1,"2022-10-21",1);
	    }

	   	//Check the Availability of Product
		public function checkProduct($product,$orgID,$pID)
		{
			$sql = "select * from products where (pName=:pName and org_id=:orgID) and pID!=:pID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['pName'=>$product,'orgID'=>$orgID,'pID'=>$pID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
		}

		//Check the Availability of Product 2 For Add Products
		public function checkProduct2($product,$orgID)
		{
			$sql = "select * from products where (pName=:pName and org_id=:orgID and is_deleted=0)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['pName'=>$product,'orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
		}

		//Delete Product
	    public function deleteProduct($pID)
	    {
	    	$sql = "update products set is_deleted=1 where pID=:pID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['pID'=>$pID]);

	        return true;
	    }
	    
	    //Update Product
	    public function updateProduct($product,$scID,$bID,$sID,$qty,$date,$buyPrice,$sellPrice,$pID)
	    {
	    	$sql = "update products set pName=:pName, scID=:scID, bID=:bID, sID=:sID, qty=:qty, buy_price=:buyPrice, sell_price=:sellPrice, date_added=:date_added where pID=:pID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['pName'=>$product, 'scID'=>$scID, 'bID'=>$bID,'sID'=>$sID,'qty'=>$qty,'date_added'=>$date,'buyPrice'=>$buyPrice, 'sellPrice'=>$sellPrice,'pID'=>$pID ]);

	        return true;
	    }

	    //Fetch Sell Price
	    public function productSellPrice($pID)
	    {
	    	$sql = "select * from products where pID=:pID;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['pID'=>$pID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	//Inventory Features Ends


	

	//Billing Features Starts

	    //Assign Bill Ref No
	    public function assignBillRefNo($orgID)
	    {
	    	$sql = "insert into bills(org_id,status) values(:org_id,1)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['org_id'=>$orgID]);

	        return true;
	    }

	    //Get Finally Added Ref No
	   	public function finallyAddedRefNo($orgID)
	    {
	    	$sql = "select * from bills where org_id=:orgID order by refNo desc limit 1;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetch();

	        return $result;
	    }

	    //Fetch All Products
	    public function fetchAllProducts2($orgID)
	    {
	        $sql = "select * from products where org_id =:orgID and status=1 and is_deleted=0;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }


	    //Fetch Products Available Quantity and Price
	   	public function fetchProductsAvailableDetails($pID)
	    {
	    	$sql = "select * from products where pID=:pID;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['pID'=>$pID]);
	        $result = $stmt->fetch();

	        return $result;
	    }


	   	//Add Bill Product
	   	public function addBillProduct($refNo,$pID,$qty,$price,$pTotal,$billDate)
	   	{
	   		$sql = "insert into billed_products(bill_ref,pID,qty,selled_price,total,date,status) values(:refNo,:pID,:qty,:price,:pTotal,:billDate,1)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['refNo'=>$refNo,'pID'=>$pID,'qty'=>$qty,'price'=>$price,'pTotal'=>$pTotal,'billDate'=>$billDate]);

	        return true;
	   	}

	   	//fetch Billed Products
	   	public function fetchAllBilledProducts($refNo)
	   	{
	   		$sql = "select b.bpID, p.pName,p.pID, b.selled_price, b.qty, b.total from billed_products b, products p where p.pID=b.pID and b.bill_ref=:refNo";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['refNo'=>$refNo]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	   	}

	   	//Decrese Product Quantity
	   	public function reduceProductQuantity($pID,$qty)
	   	{
	   		$sql = "update products set qty = qty-:qty where pID=:pID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['pID'=>$pID,'qty'=>$qty]);

	        return true;
	   	}

	   	//Fetch Sub Total
	   	public function fetchSubTotal($refNo)
	    {
	    	$sql = "select sum(total) as sumTotal from billed_products where bill_ref=:refNo;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['refNo'=>$refNo]);
	        $result = $stmt->fetch();

	        return $result;
	    }

	    //Remove Bill Product
	   	public function removeBillProduct($bpID)
	   	{
	   		$sql = "delete from billed_products where bpID=:bpID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['bpID'=>$bpID]);

	        return true;
	   	}

	   	//Increase Product Quantity
	   	public function increaseProductQuantity($pID,$qty)
	   	{
	   		$sql = "update products set qty = qty+:qty where pID=:pID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['pID'=>$pID,'qty'=>$qty]);

	        return true;
	   	}

	   	//Finish Order
	   	public function updateBill($refNo,$billDate,$cusName,$subTotal,$discount,$serviceCharge,$total)
	   	{
	   		$sql = "update bills set cusName=:cusName, sub_total=:subTotal, discount=:discount, service_charge=:serviceCharge, total=:total, date=:billDate where refNo=:refNo";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['refNo'=>$refNo,'billDate'=>$billDate,'cusName'=>$cusName,'subTotal'=>$subTotal,'discount'=>$discount,'serviceCharge'=>$serviceCharge,'total'=>$total]);

	        return true;
	   	}

	   	//

	   	//Select Bill Details For PDF
	   	public function selectBillDetails($refNo)
	    {
	    	$sql = "select b.cusName, b.sub_total, b.discount, b.service_charge, b.total, b.org_id,b.date, u.org_name from bills b, users u where b.org_id=u.org_id and refNo =:refNo;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['refNo'=>$refNo]);
	        $result = $stmt->fetch();

	        return $result;
	    }

	   	//select Billed Products Details For PDF
	   	public function selectBilledProductsDetails($refNo)
	   	{
	   		$sql = "select b.bpID, p.pName,p.pID, b.selled_price, b.qty, b.total from billed_products b, products p where p.pID=b.pID and b.bill_ref=:refNo";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['refNo'=>$refNo]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	   	}


	//Billing Features Ends




	//Reporting Features Starts

	   	//Update Product Price History
	    public function updateProductPriceHistory($pID,$orgID,$price)
	    {
	    	$sql = "insert into price_history(pID,price,org_id,status) values(:pID,:price,:org_id,1)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['pID'=>$pID, 'org_id'=>$orgID, 'price'=>$price ]);

	        return true;
	    }

	    //Fetch All Product Price History
	    public function fetchAllProductPriceHistory($orgID)
	    {
	    	$sql = "select h.price, h.date, p.pName from price_history h , products p where h.pID = p.pID and h.org_id=:orgID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	    //Fetch All Transactions History
	    public function fetchAllTransactionsHistory($orgID)
	    {
	    	$sql = "select * from bills where org_id=:orgID and cusName!=''";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	    //Fetch All Sales History
	    public function fetchAllSalesHistory($orgID)
	    {
	    	$sql = "select p.pName, sum(b.qty) as Number_Of_Items, b.date from products p, billed_products b where p.pID = b.pID and p.org_id = :orgID group by b.pID;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

		//Fetch Top Selling Items
	    public function fetchTopSellingItems($orgID)
	    {
	    	$sql = "select p.pName, sum(b.qty) as Number_Of_Items, b.date from products p, billed_products b where p.pID = b.pID and p.org_id = :orgID group by b.pID order by Number_Of_Items desc limit 5;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	   	//Count Products
	    public function countProducts($orgID)
	    {
	    	$sql = "select * from products where org_id=:orgID and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $count = $stmt->rowCount();

        	return $count;
	    }

	    //Count Sales
	    public function countTransactions($orgID)
	    {
	    	$sql = "select * from bills where org_id=:orgID and cusName!=''";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $count = $stmt->rowCount();

        	return $count;
	    }

	   	//Count Main Categories
	    public function countMainCategories($orgID)
	    {
	    	$sql = "select * from main_categories where orgID=:orgID and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $count = $stmt->rowCount();

        	return $count;
	    }

	   	//Count Sub Categories
	    public function countSubCategories($orgID)
	    {
	    	$sql = "select * from sub_categories where org_id=:orgID and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $count = $stmt->rowCount();

        	return $count;
	    }

	    //Count Brands
	    public function countBrands($orgID)
	    {
	    	$sql = "select * from brands where org_id=:orgID and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $count = $stmt->rowCount();

        	return $count;
	    }

	    //Count Suppliers
	    public function countSuppliers($orgID)
	    {
	    	$sql = "select * from suppliers where org_id=:orgID and is_deleted=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $count = $stmt->rowCount();

        	return $count;
	    }

	    //Count Total Users
	    public function countTotalUsers()
	    {
	    	$sql = "select * from users";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute();
	        $count = $stmt->rowCount();

        	return $count;
	    }

	    //Count Active Users
	    public function countActiveUsers()
	    {
	    	$sql = "select * from users where status=1";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute();
	        $count = $stmt->rowCount();

        	return $count;
	    }

	    //Count Non Active Users
	    public function countNonActiveUsers()
	    {
	    	$sql = "select * from users where status=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute();
	        $count = $stmt->rowCount();

        	return $count;
	    }

	   	//Count Admin Feedbacks
	    public function countAdminFeedbacks()
	    {
	    	$sql = "select * from notifications where mTo = 0 and nType = 1;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute();
	        $count = $stmt->rowCount();

        	return $count;
	    }

	   	//Count User Registration
	    public function countUserRegistration()
	    {
	    	$sql = "select reg_date,count(*) as count from users where reg_date >= current_date - 7 group by reg_date;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute();
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	    //Count Site Hits
	    public function countSiteHits()
	    {
	        $sql = "select * from site_hits where id=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute();
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	    //Update Site Hits
	    public function updateSiteHits()
	    {
	    	$sql = "update site_hits set hits = hits + 1 where id=0";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute();

	        return true;
	    }

	    //Count Current Day Sales
	    public function countCurrentDaySales($orgID)
	    {
	        $sql = "select sum(bp.qty) as count from billed_products bp , bills b where b.refNo = bp.bill_ref and  bp.date = current_date and b.org_id=:orgID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetch();

	        return $result;
	    }

	    //Count Preavious Day Sales
	    public function countPreaviousDaySales($orgID)
	    {
	        $sql = "select sum(bp.qty) as count from billed_products bp , bills b where b.refNo = bp.bill_ref and  bp.date = current_date-1 and b.org_id=:orgID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetch();

	        return $result;
	    }

	   	//Count Current Week Sales
	    public function countCurrentWeekSales($orgID)
	    {
	        $sql = "select sum(bp.qty) as count from billed_products bp , bills b where b.refNo = bp.bill_ref and  (bp.date BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()) and b.org_id=:orgID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetch();

	        return $result;
	    }

	    //Count Preavious 2 Weeks Sales
	    public function countPreaviousTwoWeeksSales($orgID)
	    {
	        $sql = "select sum(bp.qty) as count from billed_products bp , bills b where b.refNo = bp.bill_ref and  (bp.date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()) and b.org_id=:orgID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetch();

	        return $result;
	    }

	   	//Count Current Month Sales
	    public function countCurrentMonthSales($orgID)
	    {
	        $sql = "select sum(bp.qty) as count from billed_products bp , bills b where b.refNo = bp.bill_ref and  (bp.date BETWEEN (NOW() - INTERVAL 30 DAY) AND NOW()) and b.org_id=:orgID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetch();

	        return $result;
	    }

	    //Count Preavious 2 Months Sales
	    public function countPreaviousTwoMonthsSales($orgID)
	    {
	        $sql = "select sum(bp.qty) as count from billed_products bp , bills b where b.refNo = bp.bill_ref and  (bp.date BETWEEN (NOW() - INTERVAL 60 DAY) AND NOW()) and b.org_id=:orgID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetch();

	        return $result;
	    }

	    //Fetch Data For Sales Graph
	    public function salesGraph($orgID)
	    {
	    	$sql = "select bp.date, sum(bp.qty) as count from billed_products bp , bills b where b.refNo = bp.bill_ref and  (bp.date BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()) and b.org_id=:orgID group by bp.date; ;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	//Reporting Features Ends




	//Notifications Features Starts

	    //Send Feedback To Admin By User
	    public function addUserFeedback($feedback,$orgID)
	    {
	    	$sql = "insert into notifications(content,nType,mFrom,mTo,org_id,status) values(:feedback,1,:org_id,0,:org_id,1)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['feedback'=>$feedback, 'org_id'=>$orgID]);

	        return true;
	    }

	    //Fetch All User Sended Feedbacks
	    public function fetchAllUserSendedFeedbacks($orgID)
	    {
	    	$sql = "select * from notifications where mFrom=:orgID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['orgID'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	   	//Fetch All Admin Panel Feedbacks
	    public function fetchAllAdminPanelFeedbacks()
	    {
	    	$sql = "select n.nID, n.content, n.org_id, n.date, n.status , u.org_name from notifications n , users u where n.org_id = u.org_id and n.mTo = 0 and n.nType = 1;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute();
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	        //select n.nID, n.content, n.org_id, n.date, n.status , u.org_name from notifications n , users u where n.org_id = u.org_id and n.mTo = 0 and n.nType = 1;
	    }
 		
 		//Send Reply Feedback
 		public function addReplyFeedback($replyFeedback,$orgID)
	    {
	    	$sql = "insert into notifications(content,nType,mFrom,mTo,org_id,status) values(:replyFeedback,1,0,:org_id,:org_id,1)";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['replyFeedback'=>$replyFeedback, 'org_id'=>$orgID]);

	        return true;
	    }

	    //Delete User Feedback
 		public function deleteUserFeedback($nID)
	    {
	    	$sql = "delete from notifications where nID=:nID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['nID'=>$nID]);

	        return true;
	    }

	    //Fetch User Notifications
	    public function fetchUserNotifications($orgID)
	    {
	        $sql = "select * from notifications where mTo=:mTo and nType = 1 and status = 1 order by nID desc";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['mTo'=>$orgID]);
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

		//Show Message
	    public function showMessage($type,$message,$heading,$nID,$timeInAgo)
	    {

	        return '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
	                     <button type="button" class="btn-close closeNotification" data-bs-dismiss="alert" aria-label="Close" data-id="'.$nID.'"></button>
	                      <h4 id="nID" style="display: none;">1</h4>
	                      <h4 class="alert-heading">'.$heading.'</h4>
	                      <p class="mb-0">'.$message.'</p>            
	                      <hr>
	                      <p> '.$timeInAgo.' </p>
	                    </div>';
	    }

	   //Show Message 2
	    public function showMessage2($type,$message,$heading)
	    {

	        return '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
	                      <h4 id="nID" style="display: none;">1</h4>
	                      <h4 class="alert-heading">'.$heading.'</h4>
	                      <p class="mb-0">'.$message.'</p>            
	                    </div>';
	    }

	    //Time in Ago
	    public function timeInAgo($timestamp)
	    {
	        date_default_timezone_set('Asia/Colombo');
	        $timestamp = strtotime($timestamp) ? strtotime($timestamp) : $timestamp;

	        $time = time()-$timestamp;

	        switch($time)
	        {   //in Secoends
	            case $time<=60: return "Just Now";
	           
	           //in Minutes
	            case $time>=60 && $time<3600: return (round($time/60) == 1) ? "A minute ago" : round($time/60)." minutes ago";

	            //in Hours
	            case $time>=3600 && $time<86400: return (round($time/3600) == 1) ? "An hour ago" : round($time/3600)." hours ago";

	            //in days
	            case $time>=86400 && $time<604800: return (round($time/86400) == 1) ? "A day ago" : round($time/86400)." days ago";

	            //in Weeks
	            case $time>=604800 && $time<2592000: return (round($time/604800) == 1) ? "A week ago" : round($time/604800)." weeks ago";

	            //in months 
	            case $time>=2592000 && $time<31104000: return (round($time/2592000) == 1)? "A month ago" : round($time/2592000)." months ago";

	            //in years 
	            case $time>=31104000: return ($round($time/31104000) == 1) ? "A year ago" : $round($time/31104000)." years ago";
	        }
	    }

	    //Close User Notifications
	    public function closeUserNotifications($nID)
	    {
	    	$sql = "update notifications set status = 0 where nID=:nID";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute(['nID'=>$nID]);

	        return true;
	    }

	    //Fetch Admin Notifications
	    public function fetchAdminNotifications()
	    {
	        $sql = "select * from notifications n, users u where n.org_id=u.org_id and n.mTo=0 and n.nType = 1 and n.status = 1 order by n.nID desc";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute();
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	    }

	   //Fetch All Admin Panel Feedbacks Where Status = 1
	    public function fetchAllAdminPanelFeedbacks2()
	    {
	    	$sql = "select n.nID, n.content, n.org_id, n.date, n.status , u.org_name from notifications n , users u where n.org_id = u.org_id and n.mTo = 0 and n.nType = 1 and n.status=1;";
	        $stmt = $this->connection->prepare($sql);
	        $stmt->execute();
	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return $result;
	        //select n.nID, n.content, n.org_id, n.date, n.status , u.org_name from notifications n , users u where n.org_id = u.org_id and n.mTo = 0 and n.nType = 1;
	    }

	//Notifications Features Ends
	
	}

?>