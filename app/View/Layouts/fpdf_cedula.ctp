<?php
App::import('Vendor', 'fpdf/fpdf');

class PDF extends FPDF {
	
	var $header_txt = "MUNICIPIO DE CUAUTITLÁN IZCALLI, ESTADO DE MÉXICO\nDIRECCIÓN DE GOBIERNO Y ASUNTOS JURÍDICOS\nSUBDIRECCIÓN DE GOBIERNO\nDEPARTAMENTO DE VIA PÚBLICA";
	
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
	
	function header() {
		
		$header_txt = utf8_decode($this->header_txt);
		
		$this->SetFont('Times', '', 8);
		
		$this->Ln(3);
		
		$this->Image('img/cizcalli_logo.png', 6, 5, 20);
		$this->MultiCell(0, 3, $header_txt, 0, 'C');
		
	}
	
}

$pdf = new PDF();

$pdf->SetMargins(6, 6);

$pdf->AddPage('P', array(140, 215));

$pdf->SetFont('Times', '', 8);

$pdf->Ln(6);
$pdf->Cell(0, 3, utf8_decode('CÉDULA PARA PUESTOS FIJOS, SEMIFIJOS O COMERCIATES AMBULANTES.'), 0, 0, 'C');

$pdf->Image("img" . DS . "{$form['Form']['owner_photo']}", 7, 33, 24, 30);

$pdf->Image('img/cizcalli_logo.png', 66, 33, 37);

// owner's photo watermark
$pdf->Image('img/cizcalli_logo.png', 23, 54, 13);

// qrcode
$pdf->Image("img/qrcodes/qrcode_{$form['Form']['id']}.png", 106, 33, 23);

$pdf->Ln(8);
$pdf->Cell(0, 3, 'DATOS PERSONALES:', 0, 0, 'C');

$pdf->Ln(5);
$pdf->Cell(25, 3, '', 0);
$pdf->Cell(0, 3, "Nombre del usuario: {$form['Form']['full_name']}", 0, 0, 'L');

$pdf->Ln(4);
$pdf->Cell(25, 3, '', 0);
$pdf->Cell(0, 3, "Domicilio: {$form['Form']['address']}", 0, 0, 'L');

$pdf->Ln(4);
$pdf->Cell(25, 3, '', 0);
$pdf->Cell(0, 3, "Colonia: {$form['Suburb']['name']}", 0, 0, 'L');

$pdf->Ln(4);
$pdf->Cell(25, 3, '', 0);
$pdf->Cell(0, 3, utf8_decode("Edad: {$form['Form']['age']} años"), 0, 0, 'L');

$pdf->Ln(6);
$pdf->Cell(104, 3, '', 0);
$pdf->Cell(0, 3, "Folio: {$form['Form']['id']}", 0, 0, 'L');

$pdf->Ln(8);
$pdf->Cell(0, 3, 'DATOS DEL PUESTO FIJO, SEMIFIJO O AMBULANTE.', 0, 0, 'C');

$pdf->Ln(5);
$pdf->Cell(0, 3, utf8_decode("Lugar de Ubcación: {$form['Form']['commerce_location']}"), 0, 0, 'L');

$pdf->Ln(4);
$pdf->Cell(0, 3, utf8_decode("Giro: {$form['Form']['commerce_order']}"), 0, 0, 'L');

$pdf->Ln(4);
$pdf->Cell(0, 3, utf8_decode("Medidas: {$form['Form']['commerce_width']}x{$form['Form']['commerce_long']} mts."), 0, 0, 'L');

$pdf->Ln(4);
$pdf->Cell(0, 3, utf8_decode("Horario: {$form['Schedule']['name']}"), 0, 0, 'L');

$pdf->Ln(6);
$pdf->SetFont('Times', '', 7);
$pdf->Cell(85, 3, '', 0);
$pdf->Cell(0, 3, 'Foto del puesto', 0, 0, 'C');
$pdf->SetFont('Times', '', 8);

$pdf->Image("img" . DS . "{$form['Form']['recent_photo']['img']}", 100, 71, 25, 18);

$pdf->Ln(4);
$pdf->Cell(0, 3, 'FUNDAMENTO LEGAL', 0, 0, 'C');

$fundamento_legal = utf8_decode('La presente se expide con fundamento en el segundo párrafo de la fraccion II del artículo 115 de la Constitución Política de los Estados Unidos Mexicanos; 123 y 124 de la Constitución Política del Estado Libre y Soberano de México; 2, 3, 31 fracción I y 164 de la Ley Organica del Estado de México; Segundo párrafo del 154 BIS del Código Financiero del Estado de México y Municipios; 54, 55, 56 y 63 del Bando Municipal 2013-2015 de Cuautitlán Izcalli Estado de México; 16 fracción XX del Reglamento Orgánico de la Administración Publica del Municipio de Cuautitlán Izcalli; párrafo segundo del artículo 13 del Reglamento Municipal de Procedimientos Administrativos de Cuautitlan Izcalli, México.');

$pdf->Ln(5);
$pdf->SetFont('Times', '', 7);
$pdf->MultiCell(0, 3, $fundamento_legal, 0, 'J');
$pdf->SetFont('Times', '', 8);

$pdf->Ln(5);
$pdf->Cell(0, 3, 'VIGENCIA', 0, 0, 'C');

$first_day = strftime("%d de Enero del %Y", mktime(0, 0, 0, 1, 1, date("Y")));
$last_day = strftime("%d de Diciembre del %Y", mktime(0, 0, 0, 12, 31, date("Y")));

$pdf->Ln(4);
$pdf->SetFont('Times', 'U', 9);
$pdf->Cell(0, 4, "$first_day hasta $last_day", 0, 0, 'C');

$pdf->SetFont('Times', '', 8);

$pdf->Ln(5);
$pdf->MultiCell(0, 3, utf8_decode("Deberá ser renovada en el mes\nde Enero del siguiente año."), 0, 'C');

$pdf->Ln(3);
$pdf->Cell(0, 3, utf8_decode("* El lugar del puesto se encuentra sujeto a reubicación si esta Autoridad determina pertinente."));

$pdf->Ln(4);
$pdf->MultiCell(0, 3, utf8_decode("* La inobservancia, incumplimiento o modificación a los términos con los que fue expedida esta cédula, será objeto de revocación o cancelación."), 0, 'J');

$pdf->Ln(1);
$pdf->Cell(0, 3, utf8_decode('* La falsificación de este documento se denunciará ante las Autoridades competentes.'), 0, 0);

$pdf->Ln(9);
$pdf->Cell(0, 3, 'Expide', 0, 0, 'C');

$pdf->Ln(8);
$pdf->Cell(0, 3 , 'LUIS ALBERTO BARAJAS NAVA', 0, 0, 'C');
$pdf->Line(45, 167, 95, 167);
$pdf->Ln();
$pdf->Cell(0, 3, utf8_decode('DIRECTOR DE GOBIERNO Y ASUNTOS JURÍDICOS'), 0, 0, 'C');

$pdf->Ln(9);
$pdf->Cell(64, 3, utf8_decode('Elaboró'), 0, 0, 'C');
$pdf->Cell(64, 3, utf8_decode('Vo.Bo.'), 0, 0, 'C');

$pdf->Ln(8);
$pdf->Cell(64, 3, utf8_decode('Meliton Montiel Domínguez'), 0, 0, 'C');
$pdf->Line(15, 187, 60, 187);
$pdf->Cell(64, 3, utf8_decode('José Benjamin López Robles'), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(64, 3, utf8_decode('Jefe Depto. de Autorizaciones y Vía Pública'), 0, 0, 'C');
$pdf->Line(78, 187, 127, 187);
$pdf->Cell(64, 3, utf8_decode('Subdirector de Gobierno'), 0, 0, 'C');

$pdf->SetFont('Times', 'B', 20);
$pdf->RotatedText(13, 130, utf8_decode("ESTA CÉDULA NO ES TRANSFERIBLE"), 27);

$pdf->Output();

exit;