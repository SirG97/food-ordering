
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gfood::vendors</title>
    <link rel="favicon" href="/favicon.ico">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/css/fontawesome-all.css">
    <link rel="stylesheet" href="/css/Chart.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/revieworder.js"></script>
    

</head>
<body>

@include('includes.nav')

<div class="container" id="root" style="margin-top: 80px;" data-token="{{$token}}">
    <div class="row">
        <div class="col-md-12">
            @include('includes.message')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="custom-panel card py-2">
                <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                   Order confirmation
                </div>  
            </div>
        </div>
        <div class="col-md-12">
            
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="custom-panel py-2">
                
            </div>
        </div>
    </div>
</div>
</body>
</html>


