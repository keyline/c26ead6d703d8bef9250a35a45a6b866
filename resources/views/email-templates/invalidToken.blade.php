<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Invalid Token</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
      }

      .container {
        margin: 50px auto;
        width: 80%;
        max-width: 600px;
      }

      .card {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
      }

      .card-header {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
      }

      .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid #f44336;
        border-radius: 5px;
        color: #f44336;
        background-color: #ffebee;
      }

      .site-logo {
        display: block;
        margin: 0 auto 20px;
        max-width: 200px;
      }

      .text-center {
        text-align: center;
      }

      .btn {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        transition: background-color 0.3s ease;
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
    </style>
  </head>
  <body>
    <div class="container">
      <div class="card">
        <div class="card-header">Invalid Token</div>
        <div class="card-body">
          <div class="alert">
            <strong>Invalid Token!</strong> The token you provided is invalid.
          </div>

            <h6>stumento</h6>


          <div class="text-center">
            <a href="{{ route('home') }}" class="btn">Back to Home</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
