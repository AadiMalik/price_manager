<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>
</head>
<body>
    <h3>Hi Dear,</h3>
    <p>Thank you for registeration at price manager.</p><br>
    <b>Your Information:</b>
    <table>
        <tbody>
            <tr>
                <td>Name:</td>
                <td>{{$details['name']??''}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{$details['email']??''}}</td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td>{{$details['phone_no']??''}}</td>
            </tr>
            <tr>
                <td>Validation Days:</td>
                <td>{{$details['validity_day']??''}}</td>
            </tr>
            <tr>
                <td>Expired Date:</td>
                <td>{{$details['expiry_date']??''}}</td>
            </tr>
            <tr>
                <td>Activation Date:</td>
                <td>{{$details['activation_date']??''}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>