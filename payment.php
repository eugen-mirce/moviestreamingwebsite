<?php include('conn.php');

session_start();
if(isset($_SESSION['_user_id'])) {
    // Get User Info
    $sql = "SELECT * FROM user WHERE id='".$_SESSION['_user_id']."'";
    $res = $conn->query($sql);
    if( $res->num_rows == 1) {
        while($row = $res->fetch_assoc()) {
            $email = $row['email'];
            $name = $row['name'];
            $status = $row['status'];
            $expiry = $row['expirydate'];
            $tdy = date("Y-m-d");
            ?>
            <head>
            <script src="js/jquery-3.5.0.js"></script>
            </head>
            <body>
            <?php if( $expiry == null || $expiry < $tdy) {
                echo "You don't have a valid subscription<br>";
            ?>
            <?php } else {
                echo 'You already have a valid subscription / But you can extend your subscription<br>';
            ?>
            <?php } ?>
            <script src="https://www.paypal.com/sdk/js?client-id=AT4TraHlfaWWF_ygUjh_pO_60iprGgj1XMHE_neXgcKSNLRhlUqFAxziy4BqKOerFw1EuiezKdPm17xk"></script>
            <div id="paypal-button-container"></div>
            <script>
                paypal.Buttons({
                    style: {
                        layout:  'vertical',
                        color:   'blue',
                        shape:   'pill',
                        label:   'pay'
                    },
                    createOrder: function(data, actions) {
                    // This function sets up the details of the transaction, including the amount and line item details.
                    return actions.order.create({
                        purchase_units: [{
                        amount: {
                            value: '10.0'
                        }
                        }]
                    });
                    },
                    onApprove: function(data, actions) {
                    // This function captures the funds from the transaction.
                    return actions.order.capture().then(function(details) {
                        // This function shows a transaction success message to your buyer.
                        alert('Transaction completed by ' + details.payer.name.given_name);
                        // TODO CHANGE STATUS AND EXPIRY DATE // SUCCESS MESSAGE
                        $.post('make_payment.php', {date: '<?php if($expiry == null || (strtotime($expiry) < strtotime('now'))) echo 'null'; else echo $expiry;?>' }, function(data){
                            alert(data);
                        });
                    });
                    },
                    onError: function (err) {
                        // Show an error page here, when an error occurs
                    }
                }).render('#paypal-button-container');
            </script>
            </body>
            <?php 
        }
    } else {
        echo $error;
    }
} else {
    /* SHOW LOGIN PAGE */
    require('login.php');
    //require('login.php?callback_url=http://localhost/web/payment.php');
}

?>