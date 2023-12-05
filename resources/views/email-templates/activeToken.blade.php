<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Account Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            max-width: 700px;
            width: 100%;
        }

        .card-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-danger {
            border: 1px solid #f44336;
            color: #f44336;
            background-color: #ffebee;
        }

        .alert-success {
            border: 1px solid #28a745;
            color: #28a745;
            background-color: #e6ffe9;
        }

        .site-logo {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        h6 {
            color: #a494fb;
            font-size: 25px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }
        .headlgoo img {
    max-width: 250px;
    margin-bottom: 20px;
}
.middleemalimg img {
    max-width: 150px;
    margin: 25px 0;
}
.container {
    width: 100%;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
}
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="headlgoo"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/logo_final.png" alt=""></div>
            <div class="card-header">Hi, Your account is verified now!!</div>

            <div class="card-body">
                <div class="middleemalimg"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/email_recived.jpg" alt=""></div>
                <!-- <div class="alert alert-success">
                    <strong>Email Validated Successfully!</strong>
                </div> -->

                <a href="{{ route('user_login') }}" class="btn btn-info">Back to Signin</a>

            </div>
        </div>
    </div>
</body>

</html>
