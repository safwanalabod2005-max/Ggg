<?php
header('Content-Type: application/json');

function parseSpecialChars($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

function decodeKeyFromUrl($key) {
    return urldecode($key);
}

$validKey = parseSpecialChars("3");// That is your key
$validIntegrityKey = parseSpecialChars("MrTusarRX");// that is integrityKey 


$key = isset($_GET['key']) ? decodeKeyFromUrl(parseSpecialChars($_GET['key'])) : '';
$integrityKey = isset($_GET['integrityKey']) ? parseSpecialChars($_GET['integrityKey']) : '';
$response = array("Status" => "Failure", "MessageString" => "Invalid key or integrity key", "Username" => "");
if ($key === $validKey && $integrityKey === $validIntegrityKey) {
    $response["Status"] = "Success";
    $response["MessageString"] = "Login successful!";
    $response["Username"] = $key; 
}

// Return the response in JSON format
echo json_encode($response);
?>
