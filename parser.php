<?php 

class Parser
{
    private $filename;
    private $filearray;
	private $parserresult;
	private $blockCount = 0;
	private $blockToPage = 4;
    
    public function __construct($filename)
    {
        $this->filename = $filename;
		$this->filearray = file($this->filename);
    }

	public function printParser()
	{
		print_r ($this->filearray);
	}
	
	public function MyPars2()
	{
		$text = '';
		foreach($this->filearray as $key => $value) {
		$text=$text.$value;
		}

		preg_match_all('/(.*)\n(.*)\n((.+(\n|$))*)(\n|$)/',$text,$result,PREG_OFFSET_CAPTURE);

		//$result=$result[0][0];

		print_r($result);


		foreach($result as $key => $value)
		{
		//	$this->parserresult = 'KEY: '.$key.'<br>'.$this->parserresult.'<br>'.$value;
		}

		//$text = print_r($this->filearray);
		//$this->parserresult = print_r($result);
	}

	public function myPars()
	{
		$text='';
		$step = 1;
		$empty_count=0;
		
		
		foreach($this->filearray as $key => $value)
		{
			if ($step == 3)
			{
				if (strlen($value)==2) {
					$empty_count=$empty_count+1;
					
					if ($empty_count==2) {
						$step=0;
						$this->blockCount = $this->blockCount + 1;
						$text=$text.'</div><br>';
					}
				}
				else {
					$empty_count=0;
					$text=$text.'<div style= "background:#AEFFF0; color:blue; font-family: Verdana, Arial, Helvetica, sans-serif; width:100%; padding: 2px;">&nbsp;&nbsp;'.$value.'</div>';
				}

			}
			
			if ($step == 2)
			{
				$text=$text.'<div style= "background:#FFBADA; color:blue; font-family: Verdana; width:70%; display: inline-block; padding: 2px;">'.$value.'</div></div><div style="border: 1px solid blue;">';
				$step=3;
			}

			if ($step == 1)
			{
				$text=$text.'<div style = "white-space: nowrap;"><div style= "background:#FF93FF; color:blue; font-family: Verdana; width:30%; display: inline-block; padding: 2px;">'.$value.'</div>';
				$step=2;
			}
			
			if ($step == 0) $step=1;
		
		}
		
		$this->blockCount = $this->blockCount + 1;
		$text=$text.'</div><br>';
		
	
		$this->parserresult = $text;
	}
	
	public function printFormat()
	{
		echo $this->parserresult;
	}

	public function printFormatHeader()
	{
		echo '

		<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Проект Гринд</title>
		<link href="/css/bootstrap.css" rel="stylesheet">


		</head>
		<body>
		';

		echo $this->parserresult;

		echo '</body></html>';
	}
	
	public function echoCount()
	{
		
		echo $this->blockCount;
	}

} 

$ParserResult = new Parser("log.txt"); 

$ParserResult->myPars2();
//$ParserResult->printFormat();
$ParserResult->printFormatHeader();

//$ParserResult->echoCount();

?>