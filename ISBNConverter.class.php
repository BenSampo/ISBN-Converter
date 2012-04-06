<?php

	class ISBNConverter {
		
		/**
		 *	Wrapper function for convertion
		 *
		 *	@param	string	$isbn			The ISBN in any format
		 *	@param	string	$convertTo		The type to convert to: "10" or "13"
		 *	@param	boolean	$format			Format the ISBN output? Defaults to true
		 *
		 *	@return string
		 */
		public function convert($isbn, $convertTo, $format = true) {
			
			if ($convertTo == '10') {
				
				$isbn = $this->to10($isbn);
				
			} elseif ($convertTo == '13') {
			
				$isbn = $this->to13($isbn);
				
			}
			
			if ($format) {
				
				$isbn = $this->format($isbn);
				
			}
			
			return $isbn;
			
		}
		
		/**
		 *	Convert ISBN to ISBN-10
		 *
		 *	@param	string	$isbn	The ISBN in any format
		 *
		 *	@return string
		 */
		public function to10($isbn) {
		
			$isbn = $this->onlyNumbers($isbn);
			
			if (!$this->isValid($isbn)) {
				
				return "Invalid ISBN";
				
			}
	
			if (strlen($isbn) == 13) {
			
				$isbnVal1 = $isbn[0] * 0;
				$isbnVal2 = $isbn[1] * 0;
				$isbnVal3 = $isbn[2] * 0;
				$isbnVal4 = $isbn[3] * 1;
				$isbnVal5 = $isbn[4] * 2;
				$isbnVal6 = $isbn[5] * 3;
				$isbnVal7 = $isbn[6] * 4;
				$isbnVal8 = $isbn[7] * 5;
				$isbnVal9 = $isbn[8] * 6;
				$isbnVal10 = $isbn[9] * 7;
				$isbnVal11 = $isbn[10] * 8;
				$isbnVal12 = $isbn[11] * 9;
				
				$isbnSum = $isbnVal1 + $isbnVal2 + $isbnVal3 + $isbnVal4 + $isbnVal5 + $isbnVal6 + $isbnVal7 + $isbnVal8 + $isbnVal9 + $isbnVal10 + $isbnVal11 + $isbnVal12;
				
				$isbnCheckSum = $isbnSum % 11;
				if ($isbnCheckSum == 10) {
				
					$isbnCheckSum = "X";
				
				}
				
				$isbnVal4 = $isbn[3];
				$isbnVal5 = $isbn[4];
				$isbnVal6 = $isbn[5];
				$isbnVal7 = $isbn[6];
				$isbnVal8 = $isbn[7];
				$isbnVal9 = $isbn[8];
				$isbnVal10 = $isbn[9];
				$isbnVal11 = $isbn[10];
				$isbnVal12 = $isbn[11];
				
				$isbn10 = $isbnVal4 . $isbnVal5 . $isbnVal6 . $isbnVal7 . $isbnVal8 . $isbnVal9 . $isbnVal10 . $isbnVal11 . $isbnVal12 . $isbnCheckSum;
				
				return $isbn10;
				
			} else if (strlen($isbn) == 10) {
				
				return $isbn;
			
			}
			
		}
		
		/**
		 *	Convert ISBN to ISBN-13
		 *
		 *	@param	string	$isbn	The ISBN in any format
		 *
		 *	@return string
		 */
		function to13($isbn) {              
		
			$isbn = $this->onlyNumbers($isbn);   
			
			if (!$this->isValid($isbn)) {
				
				return "Invalid ISBN";
				
			}
			
			if (strlen($isbn) == 10) {
							
				$isbnVal1 = 9 * 1;
				$isbnVal2 = 7 * 3;
				$isbnVal3 = 8 * 1;
				$isbnVal4 = $isbn[0] * 3;
				$isbnVal5 = $isbn[1] * 1;
				$isbnVal6 = $isbn[2] * 3;
				$isbnVal7 = $isbn[3] * 1;
				$isbnVal8 = $isbn[4] * 3;
				$isbnVal9 = $isbn[5] * 1;
				$isbnVal10 = $isbn[6] * 3;
				$isbnVal11 = $isbn[7] * 1;
				$isbnVal12 = $isbn[8] * 3;
				
				$isbnSum = $isbnVal1 + $isbnVal2 + $isbnVal3 + $isbnVal4 + $isbnVal5 + $isbnVal6 + $isbnVal7 + $isbnVal8 + $isbnVal9 + $isbnVal10 + $isbnVal11 + $isbnVal12;
				
				$isbnRemainder = $isbnSum % 10;
				$isbnCheckSum = 10 - $isbnRemainder;
				if ($isbnCheckSum == 10) {
					$isbnCheckSum = 0;
				}
				
				$isbnVal1 = $isbn[0];
				$isbnVal2 = $isbn[1];
				$isbnVal3 = $isbn[2];
				$isbnVal4 = $isbn[3];
				$isbnVal5 = $isbn[4];
				$isbnVal6 = $isbn[5];
				$isbnVal7 = $isbn[6];
				$isbnVal8 = $isbn[7];
				$isbnVal9 = $isbn[8];
			
				$isbn13 = "978" . $isbnVal1 . $isbnVal2 . $isbnVal3 . $isbnVal4 . $isbnVal5 . $isbnVal6 . $isbnVal7 . $isbnVal8 . $isbnVal9 . $isbnCheckSum;
				
				return $isbn13;
				
			} else if (strlen($isbn) == 13) {
				
				return $isbn;
			
			}
			
		}
		
		/**
		 *	Checks validity of ISBN
		 *
		 *	@param	string	$isbn	The ISBN in any format
		 *
		 *	@return boolean
		 */
		public function isValid($isbn) {
		 	
			$isbn = $this->onlyNumbers($isbn);
			
			if (strlen($isbn) == 10) { 
				
				$sum = 0;
				for ($i = 0; $i < strlen($isbn); $i++) { 
				
					if (strtoupper($isbn[$i]) == 'X') { 
						
						$sum += ((10-$i) * 10);
						
					} else {
					
						$sum += ((10-$i) * floor($isbn[$i])); 
					
					}
				
				}
				 
				return (($sum % 11) === 0); 
				
			} elseif (strlen($isbn) == 13) {
				
				$sum = 0;
				$multiplication = 1;
				
				for ($i = 0; $i < 12; $i++) { 
		
					$sum += ($multiplication * floor($isbn[$i]));
					
					if ($multiplication == 1) {
						
						$multiplication = 3;
						
					} else {
						
						$multiplication = 1;
						
					}
				
				}
				
				$checkDigitShouldBe = 10 - ($sum % 10);
				
				if ($checkDigitShouldBe == 10) {
				
					$checkDigitShouldBe = 0;
				
				}
		
				$checkDigit = $isbn[12];
		
				if ($checkDigit == $checkDigitShouldBe) {
					
					return true;
					
				}
				
			}
		
			return false;	
			
		}
		
		/**
		 *	Format ISBN-10 or ISBN-13
		 *
		 *	@param	string	$isbn	The ISBN in any format
		 *
		 *	@return string
		 */
		public function format($isbn) {	
		
			$isbn = $this->onlyNumbers($isbn);
			
			if (strlen($isbn) == 10) {
			
				$isbn = $isbn[0] . '-' . $isbn[1] . $isbn[2] . '-' . $isbn[3] . $isbn[4] . $isbn[5] . $isbn[6] . $isbn[7] . $isbn[8] . '-' . $isbn[9];
				return $isbn;
				
			} elseif (strlen($isbn) == 13) {
			
				$isbn = $isbn[0] . $isbn[1] . $isbn[2] . '-' . $isbn[3] . '-' . $isbn[4] . $isbn[5] . '-' . $isbn[6] . $isbn[7] . $isbn[8] . $isbn[9] . $isbn[10] . $isbn[11] . '-' . $isbn[12];
				return $isbn;
				
			} else {
				
				return "Invalid ISBN";
				
			}
			
		}
		
		/**
		 *	Remove anything but 0-9 and x X from string
		 *
		 *	@param	string	$text	Any string containing an ISBN
		 *
		 *	@return string
		 */
		private function onlyNumbers($text) {
		
			return preg_replace("/[^0-9xX]/","", $text); 
			
		}
	
	}

?>