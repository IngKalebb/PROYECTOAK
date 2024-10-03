<?php
// Incluir la librería de FPDF
require("lib/fpdf/fpdf.php");

class PDF extends FPDF {
    // Cabecera
    function Header() {
        $this->Image("img/pdf.png",10,8,33);
        $this->SetFont("Arial", 'B', 15);
        $this->Cell(110);
        $this->Cell(60, 10, 'REPORTE DE USUARIOS EXISTENTES', 0, 0, 'C');
        $this->Ln(30);
        $this->SetFillColor(255,255,255);//Color a la celda
        $this->SetTextColor(105,25,25);//Color al Texto
        $this->SetFont("Arial", 'B', 12);
        $this->Cell(24, 10, 'Nombre', 1, 0, 'C', tru<e);
        $this->Cell(34, 10, 'Paterno', 1, 0, 'C', true);
        $this->Cell(34, 10, 'Materno', 1, 0, 'C',true);
        $this->Cell(65, 10, 'Correo Electronico', 1, 0, 'C',true);
        $this->Cell(38, 10, 'Numero Telefonico', 1, 0, 'C',true);
        $this->Ln();
    }

    // Pie de página
    function Footer() {
        // Posición a 1.5 cm del final de la página
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo(), 0, 0, 'C');
    }
}

// Incluir la conexión a la base de datos
require("../Servidor/conexion.php");

// Asegurarse de que la conexión se estableció correctamente
if (mysqli_connect_errno()) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// Consulta a la base de datos
$consulta = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexion, $consulta);

if (!$resultado) {
    die('Error en la consulta: ' . mysqli_error($conexion));
}

$pdf = new PDF('P');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

// Fetch data and display it in the PDF
while ($row = mysqli_fetch_assoc($resultado)) {
    $pdf->Cell(24, 10, utf8_decode($row['NomUsu']), 1, 0, 'C');
    $pdf->Cell(34, 10, $row['ApaUsu'], 1, 0, 'C');
    $pdf->Cell(34, 10, utf8_decode($row['AmaUsu']), 1, 0, 'C');
    $pdf->Cell(65, 10, $row['Correo'], 1, 0, 'C');
    $pdf->Cell(38, 10, $row['telefono'], 1, 0, 'C');
    $pdf->Ln();
}

$pdf->Output();
?>