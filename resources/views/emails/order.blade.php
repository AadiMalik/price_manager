<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Place</title>
</head>
<body>
    <h3>Hi Dear,</h3>
    <p>Thank you for order at price manager.</p><br>
    <b>Order Information:</b>
    <table>
        <tbody>
            <tr>
                <td>Order no:</td>
                <td>{{$details['order_no']??''}}</td>
            </tr>
            <tr>
                <td>Name:</td>
                <td>{{$details['name']??''}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{$details['email']??''}}</td>
            </tr>
            <tr>
                <td>Phone 1:</td>
                <td>{{$details['phone1']??''}}</td>
            </tr>
            <tr>
                <td>Phone 2:</td>
                <td>{{$details['phone2']??''}}</td>
            </tr>
            <tr>
                <td>Phone 3:</td>
                <td>{{$details['phone3']??''}}</td>
            </tr>
            <tr>
                <td>Address:</td>
                <td>{{$details['address']??''}}</td>
            </tr>
            <tr>
                <td>City:</td>
                <td>{{$details['city']??''}}</td>
            </tr>
            <tr>
                <td>Shipping Charge:</td>
                <td>{{$details['shipping_charge']??''}}</td>
            </tr>
            <tr>
                <td>Total QTY:</td>
                <td>{{$details['qty']??''}}</td>
            </tr>
            <tr>
                <td>Discount:</td>
                <td>{{$details['discount']??''}}</td>
            </tr>
            <tr>
                <td>Tax:</td>
                <td>{{$details['tax']??''}}</td>
            </tr>
            <tr>
                <td>Sub Total:</td>
                <td>{{$details['sub_total']??''}}</td>
            </tr>
            <tr>
                <td>Total:</td>
                <td>{{$details['total']??''}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>