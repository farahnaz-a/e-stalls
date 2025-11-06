<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Address Validation</title>
</head>
<body>
    <form action="{{ url('address-validation') }}" method="get">
        <p>{{ $status }}</p>
        <input type="text" name="postal_code" placeholder="postal code"> <br>
        <input type="text" name="house_number" placeholder="House number"> <br>
        <button type="submit">Submit</button>
        <br>
        <p>
            @php
                dd($data);
            @endphp
        </p>
    </form>
</body>
</html>