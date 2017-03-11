<?php
    ob_start();
	include_once "resources.php";
	include_once "MultichainClientTest.php";
	include_once "HelperFunctions.php";

	try
	{
		/**
		*** Prints transaction and Block details for a stream item.
		*/
		function printBlockAndTransactionDetailsForStreamItem($streamItem)
		{
			global $mcTest;
			// Printing the transaction details for the Hash. printStreamItemDetailsVertically method from HelperFunctions.php
			echo "<p style='color:blue'><b><u>"."Transaction Details"."</u></b></p>".printStreamItemDetailsVertically($streamItem);
			

			if (isset($streamItem['blockhash']) && !empty($streamItem['blockhash']))
			{
				$blockInfo = $mcTest->GetBlock($streamItem['blockhash']);

				// Printing the block details for the hash. printBlockDetailsVertically method from HelperFunctions.php
				echo "<br><p style='color:blue'><b><u>"."Block Details"."</u></b></p>".printBlockDetailsVertically($blockInfo);
			}
		}


		if(isset($_GET['hash'])) {
			$streamKey =  $_GET['hash'];
		}
		else {
			throw new Exception("Invalid Hash");
		}
		
		$action = (isset($_GET['action']) ? $_GET['action'] : "" );
		$mcTest = new MultichainClientTest();
		$mcTest->setUp(MultichainParams::HOST_NAME, MultichainParams::RPC_PORT, MultichainParams::RPC_USER, MultichainParams::RPC_PASSWORD);

		if($action == "upload")
		{
			$items = $mcTest->ListStreamKeyItems(MultichainParams::STREAMS['PROOF_OF_EXISTENCE'], $streamKey, true, 1, -1, true);

			if (count($items) > 0)
			{
				echo "<h3 style='color:green'><b>Document already exists!!</b></h3>";	// Displayed when an existing hash is tried to be uploaded again.

				printBlockAndTransactionDetailsForStreamItem($items[0]);
			}
			else {
				// Writing the hash to the proof_of_existence data stream
				$txId = $mcTest->PublishFrom(MultichainParams::MANAGER_ADDRESS, MultichainParams::STREAMS['PROOF_OF_EXISTENCE'], $streamKey, "");

				// Print Transaction ID for the upload.
				echo "<b><font color='green'>Hash uploaded.<br/>"."Transaction ID is </font></b>".$txId;
			}
		}
		else if($action == "verify")
		{
			$items = $mcTest->ListStreamKeyItems(MultichainParams::STREAMS['PROOF_OF_EXISTENCE'], $streamKey, true, 1, 0, true);	//Gets all items from stream for the specified stream key

			if (count($items) > 0)
			{
				echo "<h3 style='color:green'><b>Document found!!</b></h3>";	// Displayed the specified hash exists in the Blockchain.

				printBlockAndTransactionDetailsForStreamItem($items[0]);
			}
			else
			{
				throw new Exception("The file does not exist in our blockchain", 1);				
			}
		}
		else
		{
			throw new Exception("Error Processing Request");			
		}
	}
	catch (exception $ex)
	{
		echo "<font color='red'><b>".$ex->getMessage()."</b></font>";
	}

?>