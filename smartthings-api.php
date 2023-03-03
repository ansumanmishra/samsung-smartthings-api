<?php
// Action can be 'on' or 'off'
function command(action) {
    // Set your access token and device ID here
    $accessToken = "XXXXXXXXXX"; // Read the README.md for details on how to generate PAT and Device id
    $deviceId = "XXXXXXX";
    // $caCertPath = "/cacert.pem"; // It is required if it thorws SSL error

    // Set the API endpoint and request body
    $apiEndpoint = "https://api.smartthings.com/v1/devices/{$deviceId}/commands";

    $requestBody = json_encode([
        "commands" => [
            [
                "component" => "main",
                "capability" => "switch",
                "command" => action,
                "arguments" => []
            ]
        ]
    ]);

    // Set the cURL options for the request
    $curlOptions = [
        CURLOPT_URL => $apiEndpoint,
    // CURLOPT_CAINFO => $caCertPath,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer {$accessToken}",
            "Content-Type: application/json"
        ],
        CURLOPT_POSTFIELDS => $requestBody
    ];

    // Create a new cURL handle and execute the request
    $curl = curl_init();
    curl_setopt_array($curl, $curlOptions);
    $response = curl_exec($curl);

    // Check for errors and print the response
    if (curl_errno($curl)) {
        $error = curl_error($curl);
        echo "Error: {$error}\n";
    } else {
        echo "Response: {$response}\n";
    }

    // Close the cURL handle
    curl_close($curl);
}

// For switching on TV
command('off');
?>