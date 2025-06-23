<?php 
require_once('TCPDF-main/tcpdf.php');

include 'db.php';

$result=$conn->query("select * from photos");

$pdf=new TCPDF();

$pdf->setAutoPageBreak(TRUE,PDF_MARGIN_BOTTOM);
$pdf->AddPage();
$pdf->setFont('times','',12);
$pdf->Cell(0,10,'Product List',0,'C');

$html= '
<table>
<tr>
<td>ID</td>
<td>Title</td>
<td>Description</td>
<td>Created date</td>
</tr>
';

while ($row=$result->fetch_assoc()) {
    
$html .= '
<tr>
<td>'.$row["id"].'</td>
<td>' .$row["title"].' </td>
<td>'.$row["descr"].'</td>
<td>'.$row["created_at"].'</td>
</tr>
';
}

$html .= '</table>';

$pdf->writeHtml($html,true,false,true,false,'');
$pdf->Output('product.pdf','D')

?>