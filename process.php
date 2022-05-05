<?php 

  include 'database/connection.php';

  session_start();

    if(isset($_GET['status']))
    {
        //* check payment status
        if($_GET['status'] == 'cancelled')
        {
            // echo 'YOu cancel the payment';
            header('Location: index.php');
        }
        elseif($_GET['status'] == 'successful')
        {
            $txid = $_GET['transaction_id'];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                  "Content-Type: application/json",
                  "Authorization: Bearer FLWSECK_TEST-f7db4daa194c783d3a9b044f5101b840-X"
                ),
              ));
              
              $response = curl_exec($curl);
              
              curl_close($curl);
              
              $res = json_decode($response);
              if($res->status)
              {
                $amountPaid = $res->data->charged_amount;
                $amountToPay = $res->data->meta->price;
                if($amountPaid >= $amountToPay)
                {
                    // Payment successful

                  $order_no= strtoupper($_SESSION['auth_user']['id'].substr(md5(rand()), 0, 7));
                   $order_date= date('jS F Y',strtotime(date('Y-m-d')))." ".date('H:i a');
                   $firstname=$_SESSION['auth_user']['firstname'];
                   $address=$_SESSION['address'];
                   $total=$_SESSION['total_price'];
                   $contact=$_SESSION['phone_number'];
                   $status=0;
                   $user_id = $_SESSION['auth_user']['id'];

                   $sql1= "insert into orders(order_no,firstname,contact,address,total,status,date,user_id) values('$order_no','$firstname','$contact','$address','$total','$status','$order_date','$user_id')";
                   $dbc1= mysqli_query($con,$sql1);



                   if ($dbc1) {
                      
                    $order_id= mysqli_insert_id($con);
                    foreach ($_SESSION['cart'] as $key => $product) {
                          $product_name= addslashes($product['product_name']);
                          $product_price= $product['product_price'];
                          $quantity=$product['qty'];
                          $totalprice=$product['totalPrice'];
                          $sql2= "insert into order_details(order_id,product_name,price,quantity,total_price) values('$order_id','$product_name','$product_price','$quantity','$totalprice')";
                          $dbc2=mysqli_query($con,$sql2);
                          if (!$dbc2) {
                              echo "Order detail failed to save :". "<br>";
                              echo mysqli_error($con);
                              die();
                          }
                       }  
                   }
                   else{
                       echo "Order failed to save";
                     echo mysqli_error($con);
                       die();
                   }
                   


                   unset($_SESSION['cart']);
                   unset($_SESSION['address']);
                   unset($_SESSION['phone_number']);
                   unset($_SESSION['total_price']);
                   unset($_SESSION['total_items']);

                   header('Location:index.php');


                    
                }
                else
                {
                    echo 'Fraud transactio detected';
                }
              }
              else
              {
                  echo 'Can not process payment';
              }
        }
    }
?>