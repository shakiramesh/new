<?php
// Include your database connection file or write the connection code here
include 'connection.php';
session_start();
if (isset($_POST['add'])) {
    $phno = $_POST['phno'];
    $user = $_POST['user'];
    
             // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO paydetails (phno, user) VALUES (?, ?, ?)");
        $stmt->bind_param("is", $phno, $user);
        // Execute the statement
        if ($stmt->execute()) {
            // Payment data inserted successfully
            // You can redirect the user or perform other actions here
        } else {
            // Handle the error
            echo "Error: " . $stmt->error;
        }
        }
   ?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
<!-- ... Existing HTML code ... -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    form {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    label {
        display: block;
        margin-bottom: 8px;
    }
    input[type="text"] {
        width: 90%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    button {
        width: 95%;
        padding: 10px;
        background-color: #9370db;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    button:hover {
        background-color: #7851a9;
    }
</style>
<!-- ... Rest of your HTML code ... -->
</head>
<body>
<!-- Create a form to capture additional payment details if needed -->
<form id="razorpay-payment-form" method="post">
<label for="bookid">Phone number:</label>
    <input type="text" name="phno" id="bookid">
    <br>
   
    <label for="username">Username:</label>
    <input type="text" name="user" id="username">
    <br>
    
<button id="rzp-button1" name="add">Pay</button>
</form>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('rzp-button1').onclick = function(e){
    var options = {
        "key": "rzp_test_3qsiob6ms5aimW", // Replace with your Razorpay key
        "amount": 100000, // Convert amount to paise
        "currency": "INR",
        "name": "Your Company Name",
        "description": "sample",
        "handler": function (response){
            alert('Payment Successful. Payment ID: ' + response.razorpay_payment_id);
            // You can redirect or update your database here
            //window.location.href = "user_bookings.php?payment_id=" + response.razorpay_payment_id;
        },
        "prefill": {
            "name": "Shaki",
            "email": "user@example.com" // You can fetch this from your database if needed
        },
        "theme": {
            "color": "#F37254"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
}
</script>
<!-- ... Rest of your code ... -->
</body>
</html>
