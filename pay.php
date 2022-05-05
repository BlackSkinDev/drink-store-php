<?php 
session_start();

if(!isset($_SESSION['auth_user'])){
    header("Location:auth/users/login.php");
}
if(isset($_POST['submit']))
{

   
   $address = $_POST['address'];
   $number = $_POST['number'];

   $_SESSION['address'] = $address;
   $_SESSION['phone_number'] = $number;


  
     $email = $_SESSION['auth_user']['email'];
     $amount = $_SESSION['total_price'];  //the amount in GBP
  

    //* Prepare our rave request
    $request = [
        'tx_ref' => time(),
        'amount' => $amount,
        'currency' => 'GBP',
        'payment_options' => 'card',
        //'redirect_url' => 'https://fredgap.000webhostapp.com/process.php',  //liveserver
        'redirect_url' => 'http://localhost:8000/process.php', // local server
        'customer' => [
            'email' => $email,
        ],
        'meta' => [
            'price' => $amount
        ],
        'customizations' => [
            'title' => 'Product payment',
            'description' => 'payment'
        ]
    ];

    //* Ca;; f;iterwave emdpoint
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($request),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer FLWSECK_TEST-f7db4daa194c783d3a9b044f5101b840-X',
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    
    $res = json_decode($response);
    if($res->status == 'success')
    {
        $link = $res->data->link;
        header('Location: '.$link);
    }
    else
    {
        echo 'We can not process your payment';
    }
}

?>