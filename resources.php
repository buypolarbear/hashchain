<?php

	/**
	*  Defines multichain params
	*/
	class MultichainParams
	{
		const HOST_NAME = "localhost";		// Hostname
		const RPC_PORT = "7446";			// The port number on which Multichain's RPC service listens
		const RPC_USER = "multichainrpc";	// User name for Multichain RPC service
		const RPC_PASSWORD = "3qzjiY7J93zN4UvzoPMzjSQMovQ5dKH8eKE8MB8fHYmr";	// Password for Multichain RPC service
		const MANAGER_ADDRESS = "1EoENKGieeRfHvSEH8mnox8J27YrGBJJDk3nvH";		// Address with admin permission and write permissions to streams

		const STREAMS = array(
				"PROOF_OF_EXISTENCE" => "proof_of_existence"		// Stream that stores hashes of files obtained from hashchain UI
			);
	}
?>