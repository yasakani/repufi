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

$pdf->SetAutoPageBreak(false, 6);

$pdf->AddPage('P', array(140, 215));

$pdf->SetFont('Times', '', 8);

$pdf->Ln(6);
$pdf->Cell(0, 3, utf8_decode('CÉDULA PARA PUESTOS FIJOS, SEMIFIJOS O COMERCIANTES AMBULANTES.'), 0, 0, 'C');

$pdf->Image("img" . DS . "{$form['Form']['owner_photo']}", 7, 33, 24, 30);

$pdf->Image('img/cizcalli_logo.png', 66, 33, 37);

// owner's photo watermark
$pdf->Image('img/cizcalli_logo.png', 23, 54, 13);

// qrcode
$pdf->Image("img/qrcodes/qrcode_{$form['Form']['id']}.png", 106, 33, 23);

$pdf->Ln(6);
$pdf->Cell(0, 3, 'DATOS PERSONALES:', 0, 0, 'C');

$pdf->Ln(5);

$pdf->SetFont('Times', '', 7);

$border = 0;

if ( strlen($form['Form']['full_name']) > 35 ) {
	$name_first = utf8_decode("{$form['Form']['lastname_pater']} {$form['Form']['lastname_mater']}");
	$name_second = utf8_decode($form['Form']['name']);
} else {
	$name_first = utf8_decode($form['Form']['full_name']);
	$name_second = '';
}

$pdf->Cell(25, 3, '', $border);
$pdf->Cell(21, 3, "Nombre del usuario:", $border);
$pdf->Cell(55, 3, $name_first, $border);
$pdf->Ln(3);
$pdf->Cell(25, 2, '', $border);
$pdf->Cell(21, 2, '', $border);
$pdf->Cell(55, 2, $name_second, $border);

$pdf->Ln(3);

if ( strlen($form['Form']['address']) > 40 ) {
	$address = str_replace(array("\n", "\r"), "", $form['Form']['address']);
	$words = split(' ', $address);
	$letters = 0;
	$address_first = '';
	$address_second = '';
	foreach ( $words as $word ) {
		$letters = $letters + strlen( $word );
		if ( $letters < 35 ) $address_first.= "$word ";
		else $address_second.= "$word ";
	}
} else {
	$address_first = $form['Form']['address'];
	$address_second = '';
}

$pdf->Cell(25, 3, "", $border);
$pdf->Cell(12, 3, "Domicilio:", $border);
$pdf->Cell(64, 3, utf8_decode($address_first), $border);
$pdf->Ln(3);
$pdf->Cell(25, 2, '', $border);
$pdf->Cell(12, 2, '', $border);
$pdf->Cell(64, 2, utf8_decode($address_second), $border);

$pdf->Ln(3);

$pdf->Cell(25, 3, '', 0);
$pdf->Cell(0, 3, utf8_decode("Colonia: {$form['Suburb']['name']}"), 0, 0, 'L');

$pdf->Ln(4);
$pdf->Cell(25, 3, '', 0);
$pdf->Cell(0, 3, utf8_decode("Edad: {$form['Form']['age']} años"), 0, 0, 'L');

$pdf->Text(110, 59, "Folio: {$form['Form']['folio']}");

$pdf->SetFont('Times', '', 8);

$pdf->Ln(11);
$pdf->Cell(0, 3, 'DATOS DEL PUESTO FIJO, SEMIFIJO O AMBULANTE.', 0, 0, 'C');

$pdf->Ln(5);

$pdf->SetFont('Times', '', 7);

if ( strlen($form['Form']['commerce_location']) >= 30 ) {
	$address = str_replace(array("\n", "\r"), "", $form['Form']['commerce_location']);
	$words = split(' ', $address);
	$letters = 0;
	$address_first = '';
	$address_second = '';
	foreach ( $words as $word ) {
		$letters = $letters + strlen( $word );
		if ( $letters < 30 ) $address_first.= "$word ";
		else $address_second.= "$word ";
	}
} else {
	$address_first = $form['Form']['address'];
	$address_second = '';
}

$pdf->Cell(22, 3, utf8_decode("Lugar de Ubicación:"), $border);
$pdf->Cell(70, 3, utf8_decode($address_first), $border);
$pdf->Ln(3);
$pdf->Cell(22, 2, '', $border);
$pdf->Cell(70, 2, utf8_decode($address_second), $border);

if ( strlen($form['Form']['commerce_order']) >= 40 ) {
	$commerce_order = str_replace(array("\n", "\r"), "", $form['Form']['commerce_order']);
	$words = split(' ', $commerce_order);
	$letters = 0;
	$order_first = '';
	$order_second = '';
	foreach ( $words as $word ) {
		$letters = $letters + strlen( $word );
		if ( $letters < 35 ) $order_first.= "$word ";
		else $order_second.= "$word ";
	}
} else {
	$order_first = $form['Form']['commerce_order'];
	$order_second = '';
}

$pdf->Ln(3);
$pdf->Cell(6, 3, 'Giro:', $border);
$pdf->Cell(87, 3, utf8_decode($order_first), $border);
$pdf->Ln(3);
$pdf->Cell(6, 2, '', $border);
$pdf->Cell(87, 2, utf8_decode($order_second), $border);

$pdf->Ln(3);
$pdf->Cell(0, 3, utf8_decode("Categoría: {$form['Category']['name']}"), $border);

$pdf->Ln(4);
$pdf->Cell(0, 3, utf8_decode("Medidas: {$form['Form']['commerce_width']}x{$form['Form']['commerce_long']} mts."), 0, 0, 'L');

$pdf->Ln(4);
$pdf->Cell(0, 3, utf8_decode("Horario: {$form['Schedule']['name']}"), 0, 0, 'L');

$pdf->SetFont('Times', '', 8);

$pdf->Ln(2);

$pdf->SetFont('Times', '', 7);
$pdf->Text(105, 92, 'Foto del puesto');
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

if ( empty($year) or !isset($year) ) $year = date('Y');

$first_day = strftime("%d de Enero del %Y", mktime(0, 0, 0, 1, 1, $year));
$last_day = strftime("%d de Diciembre del %Y", mktime(0, 0, 0, 12, 31, $year));

$pdf->Ln(4);
$pdf->SetFont('Times', 'U', 9);
$pdf->Cell(0, 4, "$first_day hasta $last_day", 0, 0, 'C');

$pdf->SetFont('Times', '', 8);

$pdf->Ln(5);
$pdf->MultiCell(0, 3, utf8_decode("Deberá Ser Renovada en los Primeros 90 Días\nNaturales del Siguiente Año."), 0, 'C');

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
$pdf->Line(45, 169, 95, 169);
$pdf->Ln();
$pdf->Cell(0, 3, utf8_decode('DIRECTOR DE GOBIERNO Y ASUNTOS JURÍDICOS'), 0, 0, 'C');

$pdf->Ln(9);
$pdf->Cell(64, 3, utf8_decode('Elaboró'), 0, 0, 'C');
$pdf->Cell(64, 3, utf8_decode('Vo.Bo.'), 0, 0, 'C');

$pdf->Ln(8);
$pdf->Cell(64, 3, utf8_decode('Meliton Montiel Domínguez'), 0, 0, 'C');
$pdf->Line(15, 189, 60, 189);
$pdf->Cell(64, 3, utf8_decode('José Benjamin López Robles'), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(64, 3, utf8_decode('Jefe Depto. de Autorizaciones y Vía Pública'), 0, 0, 'C');
$pdf->Line(78, 189, 127, 189);
$pdf->Cell(64, 3, utf8_decode('Subdirector de Gobierno'), 0, 0, 'C');

$pdf->SetFont('Times', 'B', 20);
$pdf->RotatedText(13, 130, utf8_decode("ESTA CÉDULA NO ES TRANSFERIBLE"), 27);

$pdf->Output();

exit;