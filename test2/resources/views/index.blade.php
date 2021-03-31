<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
    <title>Test2</title>
    <style>
        html, body {
            background-color: #f1efef;
            font-weight: bold;
            margin-top: 50px;
            padding: 5%
        }
        td {
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h5 class="text-center">
            Write a psr-4 package to validate excel file format and its data. For this test, you will have to validate two types of excel file Type_A and Type_B.
        </h5>
        @if (Session::get('result'))
        <div class="alert alert-danger">
            <div class="ContentError">
                @if(is_array(Session::get('result')))
                <table border="1" style="width: 100%" cellpadding="3" cellspacing="3" >
                    <tr>
                        <td class="text-center">Row</td>
                        <td class="text-left">Error</td>
                    </tr>
                    @foreach (Session::get('result') as $data)
                    @if ($data['error'] && !empty($data['error']))
                    <tr>
                        <td class="text-center">{{ $data['row'] }}</td>
                        <td>{{ $data['error'] }}</td>
                    </tr>
                    @endif
                    @endforeach
                </table>
                @else
                <p class="text-center">{{Session::get('result')}}</p>
                @endif
            </div>
        </div>
        @endif
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h5 class="text-center"> Choose your xls/xlsx File :  </h5>
            <input type="file" name="file" class="form-control" required style="margin-top: 20px;margin-bottom: 20px">
            <input type="submit" value="Process Data !" class="btn btn-block btn-success btn-md">
        </form>
    </div>
</body>
</html>