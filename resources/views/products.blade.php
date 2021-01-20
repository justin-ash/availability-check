<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Availability Check</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Items Availablity</h2>
                </div>
            </div>
            <table class="table table-boarderd" style="width: 100%;border:1px solid #ccc">
                <thead>
                    <tr>
                        <th>#no</th>
                        <th>Items</th>
                        <th>Criteria</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index => $product )
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$product->name}}</td>
                        <td>@if(!empty($product->availability))
                            @foreach($product->availability as $availability )
                            {!! $availability !!} <br>
                            @endforeach
                            @endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
