<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 *  ======================================= 
 *  Author     : Poonam
 *  Purpose    : Generating Word File
 *  ======================================= 
 */  
 
require_once APPPATH."/third_party/PHPWord.php"; 
  
class Word extends PHPWord { 
    public function __construct() { 
        parent::__construct(); 
    }
//$compantName
	function word_OBC($amount,$amountInWord,$compName)
   	{
    	$CI =& get_instance(); 
    	$current_date = "Date:". date('d M Y');
    	//load our new PHPWord library
    	$CI->load->library('word');		
    	
   		$sectionStyle = array('orientation' => null,
						    'marginLeft' => 1000,
						    'marginRight' => 1000,
						    'marginTop' => 800,
						    'marginBottom' => 800);


		$section = $CI->word->createSection($sectionStyle);
		
		// Add text elements
		$CI->word->addFontStyle('uStyle', array('name'=>'Bookman Old Style','bold'=>true, 'size'=>16, 'underline'=>PHPWord_Style_Font::UNDERLINE_SINGLE));
		$CI->word->addFontStyle('rStyle', array('name'=>'Bookman Old Style','bold'=>true, 'size'=>10));
		$CI->word->addParagraphStyle('pStyle', array('name'=>'Bookman Old Style','spaceAfter'=>0));
		// $CI->word->addParagraphStyle('aStyle', array('align'=>'left', 'spaceAfter'=>100,'spacing' => 0));
		// $CI->word->addParagraphStyle('sStyle', array('align'=>'center', 'spaceAfter'=>100,'spacing' => 0));
		
		$section->addText($current_date);
		$section->addTextBreak(1);
		$section->addText('To,','rStyle');
		$section->addText('The Manager,','rStyle');
		$section->addText('Oriental Bank of Commerce,','rStyle');
		$section->addText('Poonam Nagar','rStyle');
		$section->addText('Andheri(E),','rStyle');
		$section->addText('Mumbai - 400093','rStyle');
		$section->addTextBreak(1);
		$section->addText('Dear Sir,');
		$section->addTextBreak(1);
		$textrun = $section->createTextRun();

		// $section->addTextBreak(1);
		$textrun->addText('Please find the details of NEFT Transfer of Rs. ');
		$textrun->addText( $amount .' /- ('.$amountInWord.' only)','rStyle');
		$textrun->addText(' to our staff. Kindly do the needful and transfer the amount from our account. (Account No. 10875011000168).');
		//$textrun->addTextBreak(1);
		$textrun1 = $section->createTextRun();
		
		$textrun1->addText('Please find attached herewith Cheque No.             of Rs.  for ');
		$textrun1->addText( $amount. ' /-  & list of employees having bank accounts in Oriental Bank Of Commerce','rStyle');
		$textrun1->addText(' for making the transfer.');
		
		$section->addTextBreak(1);
		$section->addText('Thanking You');

		$section->addTextBreak(2);
		$section->addText('Yours Faithfully');
		
		$section->addTextBreak(1);
		$section->addText('For '.$compName,'rStyle');

		$section->addTextBreak(2);
		$section->addText('Ratan Moondra','rStyle');

		$section->addText('Director','rStyle');

		$filename=$compName."-OBC";
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		             
		// Save File
		$objWriter = PHPWord_IOFactory::createWriter($CI->word, 'Word2007');
		//$objWriter->save($filename);
		$objWriter->save('php://output');
	}

	function word_other_than_OBC($amount,$amountInWord,$compName)
   	{
    	$CI =& get_instance(); 
    	$current_date = "Date:". date('d M Y');
    	//load our new PHPWord library
    	$CI->load->library('word');		
    	
   		$sectionStyle = array('orientation' => null,
						    'marginLeft' => 1000,
						    'marginRight' => 1000,
						    'marginTop' => 800,
						    'marginBottom' => 800);


		$section = $CI->word->createSection($sectionStyle);

		// Add text elements
		// $CI->word->addFontStyle('uStyle', array('bold'=>true, 'size'=>16, 'underline'=>PHPWord_Style_Font::UNDERLINE_SINGLE));
		// $CI->word->addFontStyle('rStyle', array('bold'=>true, 'size'=>10));
		// $CI->word->addParagraphStyle('pStyle', array('spaceBefore' => 0,'spaceAfter'=>0,'spacing' => 0));
		// $CI->word->addParagraphStyle('aStyle', array('align'=>'left', 'spaceAfter'=>100,'spacing' => 0));
		// $CI->word->addParagraphStyle('sStyle', array('align'=>'center', 'spaceAfter'=>100,'spacing' => 0));
		$CI->word->addFontStyle('uStyle', array('name'=>'Bookman Old Style','bold'=>true, 'size'=>16, 'underline'=>PHPWord_Style_Font::UNDERLINE_SINGLE));
		$CI->word->addFontStyle('rStyle', array('name'=>'Bookman Old Style','bold'=>true, 'size'=>10));
		$CI->word->addParagraphStyle('pStyle', array('name'=>'Bookman Old Style','spaceAfter'=>0));

		$section->addText($current_date);
		$section->addText('To,','rStyle');
		$section->addText('The Manager,','rStyle');
		$section->addText('Oriental Bank of Commerce,','rStyle');
		$section->addText('Poonam Nagar','rStyle');
		$section->addText('Andheri(E),','rStyle');
		$section->addText('Mumbai - 400093','rStyle');
		$section->addTextBreak(1);
		$section->addText('Dear Sir,');
		$section->addTextBreak(1);
		$textrun = $section->createTextRun();

		$section->addTextBreak(1);
		// $textrun->addText('Please find the details of NEFT Transfer of Rs. '.$amount.' to our staff. Kindly do the needful and transfer the amount from our account. (Account No. 10875011000168). ');
		$textrun->addText('Please find the details of NEFT Transfer of Rs. ');
		$textrun->addText( $amount .' /- (' .$amountInWord.' only)','rStyle');
		$textrun->addText(' to our staff. Kindly do the needful and transfer the amount from our account. (Account No. 10875011000168).');
		$textrun1 = $section->createTextRun();
		
		$textrun1->addText('Please find attached herewith Cheque No.060595 of Rs.  ');
		$textrun1->addText( $amount .' /-  ','rStyle');
		$textrun1->addText(' & list of employees having bank accounts other than Oriental Bank Of Commerce','rStyle');
		$textrun1->addText(' for making the transfer.');
		
		$section->addTextBreak(1);
		$section->addText('Thanking You');

		$section->addTextBreak(2);
		$section->addText('Yours Faithfully');
		
		$section->addTextBreak(1);
		$section->addText('For '.$compName,'rStyle');

		$section->addTextBreak(2);
		$section->addText('Ratan Moondra','rStyle');

		$section->addText('Director','rStyle');

		$filename=$compName."-OTOBC";
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser whats the file name
		header('Cache-Control: max-age=0'); //no cache

		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		             
		// Save File
		$objWriter = PHPWord_IOFactory::createWriter($CI->word, 'Word2007');
		//$objWriter->save($filename);
		$objWriter->save('php://output');
	}
}