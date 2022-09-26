<?php
require_once __DIR__ . '/vendor/autoload.php';

$googleAccountKeyFilePath = __DIR__ . '/service_key.json';
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath);

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(['https://www.googleapis.com/auth/drive', 'https://www.googleapis.com/auth/spreadsheets']);
$service = new Google_Service_Sheets($client);

$SpreadsheetProperties = new Google_Service_Sheets_SpreadsheetProperties();
$SpreadsheetProperties->setTitle('TopvisorTestTask');
$Spreadsheet = new Google_Service_Sheets_Spreadsheet();
$Spreadsheet->setProperties($SpreadsheetProperties);
$response = $service->spreadsheets->create($Spreadsheet);
$Drive = new Google_Service_Drive($client);
$DrivePermisson = new Google_Service_Drive_Permission();
$DrivePermisson->setType('user');
$DrivePermisson->setEmailAddress('d.balina92@gmail.com');
$DrivePermisson->setRole('writer');
$response = $Drive->permissions->create('1OYT6SMkqc3Xd4tptR_AhCKenpZa92RWIHD1njWTtlk0', $DrivePermisson);
$spreadsheetId = '1OYT6SMkqc3Xd4tptR_AhCKenpZa92RWIHD1njWTtlk0';

$values = [
    ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
];
$ValueRange = new Google_Service_Sheets_ValueRange();
$ValueRange->setMajorDimension('COLUMNS');
$ValueRange->setValues($values);
$options = ['valueInputOption' => 'USER_ENTERED'];
$service->spreadsheets_values->update($spreadsheetId, 'Sheet1!A1', $ValueRange, $options);
?>