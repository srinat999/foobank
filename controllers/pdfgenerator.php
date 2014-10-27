<?php
require ('../lib/fpdf/fpdf.php');
require ('utils.php');
require_once ('DbConnector.php');
session_start();
//$account = getAccountNumber ($_COOKIE ['TUMsession']);
$account=$_POST['PDF'];
$db = new DbConnector ();
$query = "SELECT * FROM transactions WHERE ((source_account=$account OR destination_account=$account) AND is_approved=1) ORDER BY creation_date DESC";
$result = $db->execQuery ( $query );
$numrows = mysqli_num_rows ( $result );

$pdf = new FPDF ();
$pdf->AddPage ();
$pdf->SetFont ( 'Helvetica', 'B', 16 );
$pdf->Cell ( 0, 0, 'Transaction History', 0, 1, 'C' );
$pdf->SetFont ( 'Arial', 'B', 14 );
$pdf->Cell ( 10, 20, 'Source Account', 0, 0 );
$pdf->Cell ( 40 );
$pdf->Cell ( 10, 20, 'Destination Account', 0, 0 );
$pdf->Cell ( 50 );
$pdf->Cell ( 10, 20, 'Amount', 0, 0 );
$pdf->Cell ( 30 );
$pdf->Cell ( 10, 20, 'Transaction Date', 0, 1 );

if ($numrows == 0) {
	$pdf->SetFont ( 'Arial', 'I', 12 );
	$pdf->Cell ( 0, 0, 'No transactions done', 0, 1, 'C' );
} else {
	$pdf->SetFont ( 'Arial', '', 12 );
	for($i = 0; $i < $numrows; ++ $i) {
		$transactions = mysqli_fetch_assoc ( $result );
		$pdf->Cell ( 5 );
		$pdf->Cell ( 5, 5, $transactions ['source_account'], 0, 0 );
		$pdf->Cell ( 55 );
		$pdf->Cell ( 5, 5, $transactions ['destination_account'], 0, 0 );
		$pdf->Cell ( 45 );
		$pdf->Cell ( 5, 5, $transactions ['amount'], 0, 0 );
		$pdf->Cell ( 25 );
		$pdf->Cell ( 5, 5, $transactions ['creation_date'], 0, 1 );
	}
}

$pdf->Output ();
// echo genPdf(1234);
?>
