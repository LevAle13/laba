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
	
	public function echoCount()
	{
		
		echo $this->blockCount;
	}

} 

$ParserResult = new Parser("log.txt"); 

$ParserResult->myPars();
$ParserResult->printFormat();

//$ParserResult->echoCount();

?>