<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="flex justify-content-center align-items-center">
<div>
    <h1 style="text-align: center; font-size: 30px; margin-top:25px;">{{env('APP_NAME')}}</h1>
    <div id="card" style="width: 40rem;">
        <div style="padding: 20px;">
            <h5 style="text-align: center; color:#718096 !important; margin: 10px 0px; font-size: 1.25rem;">Hi Admin, Someone want connect with us</h5>
            <p style="text-align: center; color:#718096; margin: 10px 0px; font-size: 16px;">Here are the details of user</p>
            <table>
                <thead>
                <tr>
                    <th colspan="2" style="background-color: black; color:white;">User Details</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $contactDetails['name'] }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $contactDetails['email'] }}</td>
                </tr>

                <tr>
                    <th>Subject</th>
                    <td>{{ $contactDetails['subject'] }}</td>
                </tr>

                </tbody>
            </table>

            <p id="message">
                {{$contactDetails['message']}}
            </p>
            <a href="http://127.0.0.1:8000" id="order-btn">Go to Home Page</a>
        </div>
    </div>
</div>

<p style="text-align: center; margin-top: 25px; font-size:14px; color:#718096;">© 2022 {{env('APP_NAME')}}. All rights reserved.</p>

</body>
</html>




<style>
    body{
        background-color: #edf2f7 !important;
        height: 100vh !important;
    }
    #card{
        background-color: white;
        margin-top: 30px;
        margin-left:auto;
        margin-right:auto;
        border-radius: 5px;

    }
    table{
        border: 1px solid #718096;
        border-collapse: collapse;
        width: 100%;
        margin: 40px 0px;
    }
    table, th, td{
        border: 1px solid #718096;
        padding: 8px;
    }
    #order-btn{
        color: #fff;
        background-color: #0d6efd;
        display: inline-block;
        font-weight: 400;
        line-height: 1.5;
        text-align: center;
        text-decoration: none;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        border-radius: 0.25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    #order-btn:hover {
        color: #fff;
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
    #message{
        font-size: 14px;
        font-family: "Helvetica Neue", sans-serif;
        margin: 20px;
    }
</style>
