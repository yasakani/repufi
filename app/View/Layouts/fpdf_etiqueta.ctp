<?php
App::import('Vendor', 'fpdf/fpdf');

class PDF extends FPDF {
	
	var $angle=0;
	
	function Rotate($angle, $x = -1, $y = -1) {
		if ( $x == -1)
			$x = $this->x;
		
		if ( $y == -1)
			$y = $this->y;
		
		if ( $this->angle != 0)
			$this->_out('Q');
		
		$this->angle = $angle;
		
		if ( $angle != 0) {
			$angle*= M_PI / 180;
			$c = cos($angle);
			$s = sin($angle);
			$cx = $x * $this->k;
			$cy = ( $this->h - $y) * $this->k;
			$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
		}
		
	}
	
	function _endpage() {
		if ( $this->angle != 0) {
			$this->angle = 0;
			$this->_out('Q');
		}
		
		parent::_endpage();
	}
	
	function RotatedText($x, $y, $txt, $angle) {
		//Text rotated around its origin
		$this->Rotate($angle,$x,$y);
		$this->Text($x,$y,$txt);
		$this->Rotate(0);
	}
	
	function RotatedImage($file, $x, $y, $w, $h, $angle) {
		//Image rotated around its upper-left corner
		$this->Rotate($angle, $x, $y);
		$this->Image($file, $x, $y, $w, $h);
		$this->Rotate(0);
	}
	
}

$pdf = new PDF();

$pdf->SetMargins(3, 3);
$pdf->SetAutoPageBreak(false, 3);

$pdf->AddPage('L', array(100, 62));

$border = 0;

$pdf->SetFont('Arial', 'B', 8);

$pdf->MultiCell(0, 3, utf8_decode('"REPUFI" REGISTRO DE PUESTOS FIJOS, SEMIFIJOS Y AMBULANTES'), 0, 'C');

$pdf->Line(3, 10, 97, 10);

$pdf->Ln(2);
$pdf->Cell(50, 3, "FOLIO NO.: {$form['Form']['folio']}", 0, 0, 'L');
$pdf->Cell(50, 3, utf8_decode("CATEGORÍA: {$form['Category']['name']}"), 0, 0, 'L');

$pdf->Ln(5);

if ( strlen($form['Form']['full_name']) > 30 )
	$pdf->SetFontSize(11);
else
	$pdf->SetFontSize(13);
$pdf->Cell(0, 5, utf8_decode("{$form['Form']['full_name']}"), $border, 0, 'L');
$pdf->SetFontSize(8);

$pdf->Line(3, 23, 97, 23);

if ( strlen($form['Form']['commerce_location']) >= 34 ) {
	$commerce_location = str_replace(array("\n", "\r"), "", $form['Form']['commerce_location']);
	$words = split(' ', $commerce_location);
	$letters = 0;
	$first_line = '';
	$second_line = '';
	foreach ( $words as $word ) {
		$letters = $letters + strlen( $word );
		if ( $letters < 34 ) $first_line.= "$word ";
		else $second_line.= "$word ";
	}
} else {
	$first_line = $form['Form']['commerce_location'];
	$second_line = '';
}

$pdf->Ln(9);
$pdf->Cell(18, 3, utf8_decode("DIRECCIÓN:"), $border, 0, 'L');
if ( strlen($form['Form']['commerce_location']) >= 34 ) {
	$pdf->SetFontSize(6);
	$height = 2;
} else {
	$height = 3;
}
$pdf->Cell(58, $height, utf8_decode($first_line), $border);
$pdf->Ln();
$pdf->Cell(18, $height, '', $border);
$pdf->Cell(58, $height, utf8_decode($second_line), $border);

$pdf->SetFontSize(8);

$pdf->Ln(3);
$pdf->Cell(70, 3, utf8_decode("COLONIA: {$form['Form']['commerce_suburb']}"), 0, 0, 'L');

$pdf->Ln(6);
$pdf->Cell(70, 3, utf8_decode("GIRO: {$form['Form']['commerce_order']}"), 0, 0, 'L');

$pdf->Line(3, 42, 80, 42);

$first_day = strftime("%e DE %B %Y", mktime(0, 0, 0, 1, 1, $year));
$last_day = strftime("%e %B %Y", mktime(0, 0, 0, 12, 31, $year));

$pdf->Ln(12);
$pdf->Cell(1, 3, '');
$pdf->SetFont('Arial', 'BU', 8);
$pdf->Cell(60, 3, strtoupper(utf8_decode("VIGENCIA: $first_day AL $last_day")), 0, 0, 'L');
$pdf->SetFont("Arial", 'B', 8);

$pdf->Ln(4);
$pdf->Cell(6, 3, '');
$pdf->Cell(60, 3, utf8_decode('Ayuntamiento de Cuautitlán Izcalli, 2013-2015'), 0, 0, 'L');

$pdf->Image('img/cizcalli_logo.png', 78, 40, 20);

$pdf->Image("img/qrcodes/qrcode_{$form['Form']['id']}.png", 80, 24, 16);

$pdf->Output();

exit;