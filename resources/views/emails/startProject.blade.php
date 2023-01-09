<!DOCTYPE html>
<html>
<head>
    <title>Start Project</title>
</head>
<body>
    {{-- @foreach($data as $datas) --}}
    {{-- <p>Email: {{ $email }}</p> --}}
    {{-- @endforeach --}}
    {{-- --}}
    <p>Category: {{ $category }}</p>

    <p>Sub Categories:</p>


    @foreach($sub_categories as $sub_category)
    <h2>{{ $sub_category }}</h2>
    @endforeach
    <p>{{ $category }}</p>

    <p>Name:{{ $name }}</p>


    <p>Phone:{{ $phone }}</p>


    <p>Email: {{ $email }}</p>


    <p>{{ $help }}</p>



</body>
</html>
