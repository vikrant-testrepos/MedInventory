<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>MedInventory Report</title>

    <style>

{!! file_get_contents(public_path('css/pdf-report.css')) !!}

    </style>

</head>

<body>

    <!-- ================= HEADER ================= -->

    <div class="header">

        <div class="logo">
            MedInventory
        </div>

        <div class="subtitle">
            Inventory & Sales Report
        </div>

        <table class="report-info">

            <tr>
                <td><strong>Report ID</strong></td>
                <td>REP-{{ date('Ymd-His') }}</td>
            </tr>

            <tr>
                <td><strong>Generated On</strong></td>
                <td>{{ date('d M Y h:i A') }}</td>
            </tr>

            <tr>
                <td><strong>Prepared By</strong></td>
                <td>Administrator</td>
            </tr>

        </table>

    </div>

    <!-- ================= SYSTEM SUMMARY ================= -->

    <div class="section-title">

        System Summary

    </div>

    <table class="summary-table">

        <tr>
            <td>Total Medicines</td>
            <td>{{ $totalMedicines }}</td>
        </tr>

        <tr>
            <td>Total Categories</td>
            <td>{{ $totalCategories }}</td>
        </tr>

        <tr>
            <td>Total Orders</td>
            <td>{{ $totalOrders }}</td>
        </tr>

        <tr>
            <td>Total Stock Available</td>
            <td>{{ $totalStock }}</td>
        </tr>

        <tr>
            <td>Low Stock Medicines</td>
            <td>{{ $lowStock }}</td>
        </tr>

        <tr>
            <td>Out Of Stock Medicines</td>
            <td>{{ $outOfStock }}</td>
        </tr>

        <tr>
            <td>Inventory Value</td>
            <td>रु. {{ number_format($inventorySellingValue,2) }}</td>
        </tr>

    </table>

    <!-- ================= LOW STOCK ================= -->

    <div class="section-title">

        Low Stock Medicines

    </div>

    <table class="data-table">

        <thead>

        <tr>

            <th>ID</th>

            <th>Medicine</th>

            <th>Category</th>

            <th>Price</th>

            <th>Quantity</th>

        </tr>

        </thead>

        <tbody>

        @forelse($lowStockMedicines as $medicine)

            <tr>

                <td>{{ $medicine->id }}</td>

                <td>{{ $medicine->name }}</td>

                <td>{{ optional($medicine->category)->name }}</td>

                <td>
                    रु. {{ number_format($medicine->price,2) }}
                </td>

                <td>{{ $medicine->quantity }}</td>

            </tr>

        @empty

            <tr>

                <td colspan="5" style="text-align:center">

                    No Low Stock Medicines

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    <!-- ================= RECENT ORDERS ================= -->

    <div class="section-title">

        Recent Orders

    </div>

    <table class="data-table">

        <thead>

        <tr>

            <th>ID</th>

            <th>Patient</th>

            <th>Medicine</th>

            <th>Quantity</th>

            <th>Status</th>

        </tr>

        </thead>

        <tbody>

        @forelse($recentOrders as $order)

            <tr>

                <td>{{ $order->id }}</td>

                <td>{{ optional($order->user)->name }}</td>

                <td>{{ optional($order->medicine)->name }}</td>

                <td>{{ $order->quantity }}</td>

                <td>{{ $order->status }}</td>

            </tr>

        @empty

            <tr>

                <td colspan="5" style="text-align:center">

                    No Orders Found

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    <!-- ================= ALL MEDICINES ================= -->

    <div class="section-title">

        Medicine Inventory

    </div>

    <table class="data-table">

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

                <td>

                    रु. {{ number_format($medicine->price,2) }}

                </td>

                <td>{{ $medicine->quantity }}</td>

            </tr>

        @endforeach

        </tbody>

    </table>

    <!-- ================= FOOTER ================= -->

    <div class="footer">

        MedInventory Inventory Management System

        <br>

        Confidential Report

    </div>

</body>

</html>