<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <title>Medicine Report</title>

    <style>

        {!! file_get_contents(public_path('css/pdf.css')) !!}

    </style>

</head>

<body>

<div class="header">

    <h1>MedInventory</h1>

    <p>Medicine Report</p>

</div>

<table>

    <thead>

    <tr>

        <th>ID</th>

        <th>Medicine</th>

        <th>Category</th>

        <th>Price</th>

        <th>Stock</th>

    </tr>

    </thead>

    <tbody>

    @foreach($medicines as $medicine)

        <tr>

            <td>{{ $medicine->id }}</td>

            <td>{{ $medicine->name }}</td>

            <td>{{ optional($medicine->category)->name }}</td>

            <td>Rs. {{ number_format($medicine->price,2) }}</td>

            <td>{{ $medicine->quantity }}</td>

        </tr>

    @endforeach

    </tbody>

</table>

<div class="footer">

Generated on {{ now()->format('d M Y h:i A') }}

</div>

</body>

</html>