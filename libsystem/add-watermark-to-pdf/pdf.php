<?php
 function add_watermark($file, $x_axis, $y_axis, $op, $outdir) 
 {
     require_once('vendor/autoload.php');
     $pdf =  new setasign\Fpdi\Fpdi();
    
     if (file_exists($file)){
         $pagecount = $pdf->setSourceFile($file);  
     } else {
        return FALSE;
     }
     for($i=1; $i <= $pagecount; $i++) {   
      
     $tpl = $pdf->importPage($i);
     $pdf->addPage();
     $size = $pdf->getTemplateSize($tpl);
     
     $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
     $data=$pdf->Image('custom.png', $x_axis, $y_axis, 0, 20, 'png');
     }
     if ($outdir === TRUE){
        $pdf->Output();
        
     } else {
         return $pdf;
     }
    
 }
//  
 
if(count($_POST)>0 && !empty($_POST['title']) && !empty($_POST['genrate_pdf']))
{

$text = $_POST['title'];
$content = $_POST['file'];
$my_img = imagecreate( 550, 60 );                             //width & height
$background  = imagecolorallocate( $my_img, 255,   0,   0);
$text_colour = imagecolorallocate( $my_img, 0, 0, 0 );
$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
imagestring( $my_img, 2, 10, 10, $text, $text_colour );
imagesetthickness ( $my_img, 5 );
imageline( $my_img, 10, 35, 405, 35, $line_colour );
header( "Content-type: image/png" );
imagepng( $my_img,'custom.png');
add_watermark($content, 15, 284, 10,TRUE);
}




?>