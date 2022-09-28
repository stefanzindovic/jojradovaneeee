<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404</title>
    <link rel="stylesheet" href="{{asset('userside/css/dashboard.css')}}">
</head>
<body style="height: 100vh;">

<div class="container d-flex align-items-center justify-content-center" style="height: 100%">
    <div>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-center">
                    <div id="icon-container" style="max-width: 85%"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="text-center">
                    <h1 class="h1 mb-4">Stranica nije dostupna</h1>
                    <a href="/" class="btn btn-premium">Nazad na početnu</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
<script>
    var animation = bodymovin.loadAnimation({
        // animationData: { /* ... */ },
        container: document.getElementById('icon-container'), // required
        path: "{{asset('userside/img/404.json')}}", // required
        renderer: 'svg', // required
        loop: true, // optional
        autoplay: true, // optional
        name: "Animation", // optional
    });
</script>
</body>
</html>
