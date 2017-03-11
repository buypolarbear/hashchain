<?php
	
	require_once('resources.php');

	function getDelimitedHashes($array, $delimiter)
	{
		$data = "";

		foreach($array as $value)
		{
			$data .= $value.$delimiter;
		}

		return rtrim($data, $delimiter);

	}


	function sortTransactionsByDate(&$transactions)
	{
		$timeArr = array();
		
		foreach ($transactions as $key => $transaction)
		{
			$timeArr[$key] = $transaction['time'];
		}

		array_multisort($timeArr, SORT_DESC, $transactions);
	}


	function sortAddressTransactionsByDocTypes(&$transactions)
	{
		$timeArr = array();
		$docArr = array();

		foreach ($transactions as $key => $transaction)
		{
			$timeArr[$key] = $transaction['time'];
			//$docArr[$key] = substr($transaction['data'][0], -12, 6);
		}

		array_multisort($timeArr, SORT_DESC, $transactions);

	}


	function getTransactionsByDocType($addressTransactions, $docType)
	{
		$transactionsByDocType = array();
		foreach($addressTransactions as $index => $transaction)
		{
			if(substr($transaction['data'][0], -12, 6) == $docType)
				array_push($transactionsByDocType, $transaction);
		}

		return $transactionsByDocType;
	}


	function getValidAddressTransactions($addressTransactions)
	{
		global $documentTypeCodes;

		$validTransactions = array();
		
		foreach($documentTypeCodes as $documentTypeCode)
		{
			$validTransactionForTheDocType = getValidAddressTransactionForTheDocType($addressTransactions, $documentTypeCode);
			
			if(count($validTransactionForTheDocType)>0)
				array_push($validTransactions, $validTransactionForTheDocType);
		}

		return $validTransactions;
	}


	function getInvalidAddressTransactions($transactions)
	{
		global $documentTypeCodes, $invalidCode;

		$invalidTransactions = array();
		
		foreach($transactions as $transaction)
		{
			if(substr($transaction['data'][0], -6) == $invalidCode)
				array_push($invalidTransactions, $transaction);
		}

		return $invalidTransactions;
	}


	function getNecessaryAddressTransactions($addressTransactions)
	{
		global $documentType;
		$filteredTransactions = array();
		$validTransaction = getValidAddressTransactionForTheDocType($addressTransactions, $documentType);
		
		if(count($validTransaction)>0)
			array_push($filteredTransactions, $validTransaction);

		$invalidTransactions = getInvalidAddressTransactions($addressTransactions);
		
		foreach($invalidTransactions as $invalidTransaction)
		{
			array_push($filteredTransactions, $invalidTransaction);
		}

		sortTransactionsByDate($filteredTransactions);
		return $filteredTransactions;

	}

	/**
	*** Searches for transactions by metadata in an existing array of transactions.
	*/
	function searchTransactionsByMetadata($arr,$metadata)
	{
		$arr_fin = array();
		foreach ($arr as $item=>$arr1)
		{

			foreach ($arr1 as $item1=>$value1)
			{
				
				if($item1=="data" && strpos("x".$value1[0], $metadata)!==0)
				{
					array_push($arr_fin, $arr1);
					return $arr_fin;
				}
			}
		}

		return $arr_fin;
	}


	/**
	*** Prints transactions from an array of transactions.
	*/
	function printTransactionsFromArray($transArr)
	{
		foreach($transArr as $index=>$trans)
		{
			echo printTransactionBasicDetailsVertically($trans)."<br/><br/>";
		}
	}


	/**
	*** Prints transactions with multiple file hashes in metadata, from an array of transactions.
	*/
	function printTransactionsByFileHashFromArray($transArr, $fileHash)
	{
		foreach($transArr as $index=>$trans)
		{
			echo printTransactionDetailsFromBulkVertically($trans, $fileHash)."<br/><br/>";
		}
	}

	/**
	*** Prints transactions from an array of transactions.
	*/
	function printDocumentsFromTransactions($transactions)
	{
		foreach($transactions as $index=>$transaction)
		{
			echo "<div>".printDocumentDetailsVertically($transaction)."</div>";
		}
	}


	/**
	*** Prints the basic details of a transaction.
	*/
	function printStreamItemDetailsVertically($transaction)
	{
		date_default_timezone_set('Asia/Kolkata');
	
		$printDetails = "<div><table class='table table-bordered' style='color:#24877d'>";

		foreach($transaction as $param_name=>$param_value)
		{		
			if($param_name=="txid")
			{
				$txId = $param_value;
			}
			else if($param_name=="myaddresses" || $param_name=="publishers")
			{
				$publisherAddress = $param_value;
			}			
			else if($param_name=="blockhash")
			{
				$blockHash = $param_value;
			}
			else if($param_name=="blockindex")
			{
				$blockIndex = $param_value;
			}
			else if($param_name=="time")
			{
				$time = $param_value;
			}
			else if($param_name=="comment")
			{
				$comment = $param_value;
			}
			else if($param_name=="data")
			{
				$data = $param_value;
			}
			else if($param_name=="confirmations")
			{
				$confirmations = $param_value;
			}

		}

		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Transaction Id</th><td align='left' style='border-style: ridge;'>".$txId."</td></tr>";
		
		//$printDetails .= "<tr height=25><th style='border-style: ridge;'>Uploader</th><td align='left' style='border-style: ridge;'>"."<a href='".ExplorerParams::ADDRESS_URL_PREFIX.$publisherAddress[0]."' target='_new'>".$publisherAddress[0]."</a>"."</td></tr>";
		
		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Block Hash</th><td align='left' style='border-style: ridge;'>".(isset($blockHash) ? $blockHash : "")."</td></tr>";
		
		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Confirmations</th><td align='left' style='border-style: ridge;'>".$confirmations."</td></tr>";

		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Time</th><td align='left' style='border-style: ridge;'>".date('m-d-Y'.',  '.'h:i:s a'.',  T', $time)."</td></tr>";

		// $printDetails .= (is_string($data[0])) ? "<tr height=25><th width=150 style='border-style: ridge;'>Data</th><td align='left' style='border-style: ridge;'>".json_encode(json_decode(hex2bin($data[0])), JSON_PRETTY_PRINT)."</td></tr>" : "";
		$printDetails .= "</table></div>";
		return $printDetails;
	}


	/**
	*** Prints the basic details of a transaction.
	*/
	function printBlockDetailsVertically($block)
	{
		date_default_timezone_set('Asia/Kolkata');
	
		$printDetails = "<div><table class='table table-bordered' style='color:#24877d'>";

		foreach($block as $param_name=>$param_value)
		{		
			if($param_name=="hash")
			{
				$blockHash = $param_value;
			}
			else if($param_name=="height")
			{
				$blockHeight = $param_value;
			}
			else if($param_name=="size")
			{
				$size = $param_value;
			}
			else if($param_name=="merkleroot")
			{
				$merkleRoot = $param_value;
			}
			else if($param_name=="tx")
			{
				$transactions = "<ul><li>".implode("</li><li>", $param_value)."</li></ul>";
			}
			else if($param_name=="confirmations")
			{
				$confirmations = $param_value;
			}
			else if($param_name=="nonce")
			{
				$nonce = $param_value;
			}
			else if($param_name=="chainwork")
			{
				$chainWork = $param_value;
			}
			else if($param_name=="previousblockhash")
			{
				$previousBlockHash = $param_value;
			}
			else if($param_name=="nextblockhash")
			{
				$nextBlockHash = $param_value;
			}
			else if($param_name=="time")
			{
				$time = $param_value;
			}

		}
		
		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Block Hash</th><td align='left' style='border-style: ridge;'>". $blockHash."</td></tr>";

		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Block Height</th><td align='left' style='border-style: ridge;'>".$blockHeight."</td></tr>";

		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Size</th><td align='left' style='border-style: ridge;'>".$size." <i>Bytes</i>"."</td></tr>";

		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Merkle root</th><td align='left' style='border-style: ridge;'>".$merkleRoot."</td></tr>";

		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Transactions</th><td align='left' style='border-style: ridge;'>".$transactions."</td></tr>";
		
		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Confirmations</th><td align='left' style='border-style: ridge;'>".$confirmations."</td></tr>";

		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Mined at</th><td align='left' style='border-style: ridge;'>".date('m-d-Y'.',  '.'h:i:s a'.',  T', $time)."</td></tr>";

		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Nonce</th><td align='left' style='border-style: ridge;'>".$nonce."</td></tr>";

		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Chainwork</th><td align='left' style='border-style: ridge;'>".$chainWork."</td></tr>";
		
		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Previous Block Hash</th><td align='left' style='border-style: ridge;'>".$previousBlockHash."</td></tr>";
		
		$printDetails .= "<tr height=25><th width=150 style='border-style: ridge;'>Next Block Hash</th><td align='left' style='border-style: ridge;'>".(isset($nextBlockHash) ? $nextBlockHash : "<i>On the way...</i>")."</td></tr>";

		$printDetails .= "</table></div>";
		return $printDetails;
	}

	
	/**
	*** Prints elements of an array in vertical format
	*/
	function printArray($arr, $lvl=0)
	{
		$ret_str = "";

		foreach($arr as $item=>$value)
		{
			$str = "";		

			for ($i = 0; $i <= $lvl; $i++)
			{
					$str= $str."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}

			$item_name = (is_numeric($item) || ($item==""))?"":$item.":";

			//echo gettype($value);
			if(gettype($value)=="array")
			{
					$ret_str .= "<br/>".$str.$item_name."<br/>";
					$ret_str .= printArray($value, $lvl+1);
					$ret_str .= "<br/>";
			}
			else
			{
					$ret_str .= $str.$item_name."&nbsp;&nbsp;".$value."<br/>";
			}

		}

		return $ret_str;

	}

	function parseArray($arr, $lvl=0)
	{

			foreach($arr as $item=>$value)
			{
			$str = "";

					for ($i = 0; $i <= $lvl; $i++)
					{
							$str= $str."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					}

			$item_name = (gettype($item)=="integer")?"":$item;

					//echo gettype($value);
					if(gettype($value)=="array")
					{
							echo "<br/>".$str.$item."<br/>".$str."{<br/>";
							parseArray($value, $lvl+1);
				echo "".$str."}<br/>";
					}
					else
					{
							echo $str.$item.":&nbsp;&nbsp;".$value."<br/>";
					}

			}

	}

?>