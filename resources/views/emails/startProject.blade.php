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
    <i>
        <h3>Congrats</h3>
    </i>
    <div>
        <p>Category: {{ $category }}</p>

    </div>

    <div>
        <p>Sub Categories:</p><br>

        <ol>
            @foreach($sub_categories as $sub_category)
            <li>{{ $sub_category }}</li>
            @endforeach

        </ol>



    </div>

    <div>

        <p>Name:{{ $name }}</p>
    </div>

    <div>

        <p>Phone:{{ $phone }}</p>
        <div>

            <div>

                <p>Email: {{ $email }}</p>
                <div>

                    <div>
                        
                        <p>{{ $help }}</p>
                        <div>



</body>
</html>
