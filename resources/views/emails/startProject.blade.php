<!DOCTYPE html>


<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Start Project</title>
</head>
<body>
    {{-- @foreach($data as $datas) --}}
    {{-- <p>Email: {{ $email }}</p> --}}
    {{-- @endforeach --}}
    {{-- --}}
    <i>
        <h3>Congrats</h3>
    </i>
    <div>
        <p>Category: {{ $category }}</p>

    </div><br>

    <div>
        <p>Sub Categories:</p><br>

        <ol>
            {{-- @foreach($sub_categories as $sub_category) --}}
            <li>{{ $sub_categories}}</li>
            {{-- @endforeach --}}

        </ol>



    </div><br>


    <div>

        <p>Name:{{ $name }}</p>
    </div><br>


    <div>

        <p>Phone:{{ $phone }}</p>
        <div><br>


            <div>

                <p>Email: {{ $email }}</p>
                <div><br>


                    <div>

                        <p>{{ $help }}</p>
                        <div>



</body>
</html>

