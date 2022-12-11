<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>ADMIN LOGIN</title>
    <style>
        body {
            background: rgb(0, 156, 255);
            background: radial-gradient(circle, rgba(0, 156, 255, 1) 0%, rgba(135, 181, 236, 1) 100%);
        }

        .my-row {
            border: solid 1px none;
            border-radius: 5px;
            height: 500px;
            background: white;
            box-shadow:
                0 2.8px 2.2px rgba(0, 0, 0, 0.034),
                0 6.7px 5.3px rgba(0, 0, 0, 0.048),
                0 12.5px 10px rgba(0, 0, 0, 0.06),
                0 22.3px 17.9px rgba(0, 0, 0, 0.072),
                0 41.8px 33.4px rgba(0, 0, 0, 0.086),
                0 100px 80px rgba(0, 0, 0, 0.12)
        }

        .login-form {
            margin-top: 100px;
            margin-left: 65px;
            width: 400px;
        }

        .my-label {
            font-size: 15px;
            font-family: auto;
            color: darkgrey;
        }
    </style>
</head>

<body>
@include('sweetalert::alert')
    <div class="container justify-content-center">
        <div class="row" style="margin-top: 100px;">
            <div class="col-md-10 offset-md-1">
                <div class="row my-row">
                    <div class="col-md-6">
                        <div class="img">
                            <img src="/logo-login.png" alt="img" style="margin: 80px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-form">
                            <h1 class="text-center" style="font-family: fangsong;">ADMIN LOGIN</h1>
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>
                                    <p>{{ session('error') }}</p>
                                </strong> Vui lòng kiểm tra lại!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <form action="/login" method="POST">
                                @csrf
                                <label class="my-label" for="email">EMAIL</label>
                                <input class="form-control my-2" type="email" name="email" placeholder="Email" required>
                                <label class="my-label" for="password">PASSWORD</label>
                                <input class="form-control my-2" type="password" name="password" placeholder="Password" required>
                                <button class="form-control btn btn-info myBtn" style="max-width: 100px; margin-left:150px;" type="submit">LOGIN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"> </script>
</body>

</html>