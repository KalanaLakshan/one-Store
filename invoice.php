<?php
	session_start();

	include_once("./assests/auth.php");

	$user = new Auth();

	 ob_start();

	include_once("./fpdf/fpdf.php");

	$refNo = $_GET["refNo"];

	$result = $user->selectBillDetails($refNo);

	$org_name = $result['org_name'];
	$date = $result['date'];
	$cusName = $result['cusName'];

	$pdf = new FPDF();
    
    $pdf->AddPage();

    $pdf->SetFont("Arial","B",20);
    $pdf->cell(200,10,$org_name,0,1,"C");

    $pdf->SetFont("Arial","",12);
    $pdf->cell(200,10,"One Store (Inventory and Billing Management System)",0,1,"C");

    $pdf->SetFont("Arial","",16);
    $pdf->Cell(50,10,"Date",0,0);
    $pdf->Cell(50,10,":   ".$date,0,1);

    $pdf->Cell(50,10,"Invoice No",0,0);
    $pdf->Cell(50,10,":   ".$refNo,0,1);

    $pdf->Cell(50,10,"Customer Name",0,0);
    $pdf->Cell(50,10,":   ".$cusName,0,1);
    $pdf->Cell(50,10,"",0,1);

    $pdf->SetFont("Arial","B",12);
    $pdf->Cell(10,10,"#",1,0,"C");
    $pdf->Cell(70,10,"Product Name",1,0,"C");
    $pdf->Cell(30,10,"Quantity",1,0,"C");
    $pdf->Cell(40,10,"Price",1,0,"C");
    $pdf->Cell(40,10,"Total",1,1,"C");

    $pdf->SetFont("Arial","",12);

    $result2 = $user->selectBilledProductsDetails($refNo);

    $i=0;

    foreach($result2 as $row)
    {
        $pdf->Cell(10,10,(++$i),1,0,"C");
        $pdf->Cell(70,10,$row['pName'],1,0,"C");
        $pdf->Cell(30,10,$row['qty'],1,0,"C");
        $pdf->Cell(40,10,$row['selled_price'],1,0,"C");
        $pdf->Cell(40,10,$row['total'],1,1,"C");
    }

    $pdf->Cell(50,10,"",0,1);

    $pdf->SetFont("Arial","",16);
    $pdf->Cell(50,10,"",0,1);
    $pdf->Cell(40,10,"Sub Total",0,0);
    $pdf->Cell(40,10,":   ".$result['sub_total'],0,1);

    $pdf->Cell(40,10,"Discount",0,0);
    $pdf->Cell(40,10,":   ".$result['discount'],0,1);

    $pdf->Cell(40,10,"Service Charge",0,0);
    $pdf->Cell(40,10,":   ".$result['service_charge'],0,1);

    $pdf->Cell(40,10,"Total",0,0);
    $pdf->Cell(40,10,":   ".$result['total'],0,1);

    $pdf->Cell(50,10,"",0,1);
    $pdf->Cell(50,10,"",0,1);

    $pdf->Cell(170,10,"........................................",0,1,"R");
    $pdf->Cell(150,10,"Signature",0,1,"R");

    
    $pdf->Output("./invoice/Invoice_".$refNo.".pdf","F");
    $pdf->Output(); 

    ob_end_flush(); 

?>