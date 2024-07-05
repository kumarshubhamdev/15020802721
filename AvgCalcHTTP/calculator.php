<?php



$url = 'http://20.244.56.144/test/auth';

// Data to be sent in the POST request
$data = array(
    'companyName' => 'goMart',
    'clientID' => '00b16d25-86f4-438c-9eb8-1dbf498cbae2',
    'clientSecret' => 'rqzOWSTkSCdMMueI',
    'ownerName' => 'Shubham',
    'ownerEmail' => 'shubhamkumar23032002@gmail.com',
    'rollNo' => '15020802721'
);


$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, $url);


curl_setopt($ch, CURLOPT_POST, 1);


curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));


curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen(json_encode($data))
));


curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


$response = curl_exec($ch);



curl_close($ch);

$data = json_decode($response, true);


$access_token=$data['access_token'];


$request_uri = $_SERVER['REQUEST_URI'];

$req=$request_uri[strlen($request_uri)-1];

if($req=='p')$req='primes';
if($req=='e')$req='even';
if($req=='f')$req='fibo';
if($req=='r')$req='rand';

$url = 'http://20.244.56.144/test/'.$req;






$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);


curl_setopt($ch, CURLOPT_HTTPGET, true);


curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $access_token
]);


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$response = curl_exec($ch);


curl_close($ch);


 $obj = json_decode($response, TRUE);
 
 $windowPrevState=array();
 $windowCurrentState=array();

foreach($obj as $value) {
	$winowdPrevState=$windowCurrentState;
    $windowCurrentState=$value;
}

$numbers = $windowCurrentState;

$length = count($windowCurrentState);

if($length<=10){}

else
{
	$copy = array_slice($windowCurrentState,$length-10-1);
	
	$windowCurrentState=&$copy;
	
}


$avg=0;

foreach($windowCurrentState as $value)
{
	$avg=$avg+$value;
}

$avg=$avg/min($length,10);








// Data to be sent in JSON format
$data = array(
    'numbers' => json_encode($numbers),
    'windowPrevState' => json_encode($windowPrevState),
    'windowCurrState' => json_encode($windowCurrentState),
    'avg' => $avg
  
);

$json_response = json_encode($data);


header('Content-Type: application/json');
header('Content-Length: ' . strlen($json_response));


echo $json_response;


?>






