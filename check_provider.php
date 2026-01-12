<?php
$json = file_get_contents('https://searchproviders-cn34hp55ga-uc.a.run.app');
$data = json_decode($json, true);

$search = 'beauty-lounge';
$found = null;

foreach ($data as $provider) {
    if (
        ($provider['id'] ?? '') == $search || 
        ($provider['username'] ?? '') == $search || 
        ($provider['companyUserName'] ?? '') == $search
    ) {
        $found = $provider;
        break;
    }
}

if ($found) {
    echo "Found Provider:\n";
    echo "ID: " . ($found['id'] ?? 'N/A') . "\n";
    echo "Username: " . ($found['username'] ?? 'N/A') . "\n";
    echo "CompanyUserName: " . ($found['companyUserName'] ?? 'N/A') . "\n";
} else {
    echo "Provider '$search' NOT found in any field (id, username, companyUserName).\n";
}
?>