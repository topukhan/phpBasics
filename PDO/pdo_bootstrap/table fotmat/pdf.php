<?php 
function generatePDF($data) {
    require_once('./tcpdf/tcpdf.php');

    // Create a new PDF document
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

    // Set document information
    // $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Player List');

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('arial', '', 12);

    // Add content to the PDF
    $html = '<h1>Player List</h1>';
    $html .= '<table border="1" style="border-collapse: collapse; width: 100%;">';
    $html .= '<thead><tr><th>Name</th><th>Email</th><th>Phone</th></tr></thead>';
    $html .= '<tbody>';
    foreach ($data as $row) {
        $html .= '<tr>';
        $html .= '<td>' . $row->name . '</td>';
        // Add more table cells as needed
        $html .= '</tr>';
    }
    $html .= '</tbody></table>';

    $pdf->writeHTML($html, true, false, true, false, '');

    // Output the PDF to the browser
    $pdf->Output('player_list.pdf', 'D');
}

// ... Rest of your existing PHP code ...

// PDF download button
if (isset($_GET['download_pdf'])) {
    generatePDF($output);
}

?>