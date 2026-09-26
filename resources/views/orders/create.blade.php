@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            <i class="fas fa-shopping-cart"></i>
            Place New Order
        </h2>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>

    </div>

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            Order Information

        </div>

        <div class="card-body">

            <form action="{{ route('orders.store') }}" method="POST">

                @csrf

                <div class="form-group">

                    <label><strong>Select Medicine</strong></label>

                    <select
                        name="medicine_id"
                        class="form-control"
                        id="medicineSelect"
                        required>

                        @foreach($medicines as $medicine)

                            <option
                                value="{{ $medicine->id }}"
                                data-price="{{ $medicine->price }}"
                                data-stock="{{ $medicine->quantity }}"

                                @if(isset($selectedMedicine) && $selectedMedicine && $selectedMedicine->id == $medicine->id)
                                    selected
                                @endif>

                                {{ $medicine->name }}
                                -
                                रु. {{ number_format($medicine->price,2) }}
                                (Stock: {{ $medicine->quantity }})

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="form-group">

                    <label><strong>Quantity</strong></label>

                    <input
                        type="number"
                        name="quantity"
                        id="quantity"
                        class="form-control"
                        value="1"
                        min="1"
                        required>

                </div>

                <div class="row mb-4">

                    <div class="col-md-4">

                        <div class="alert alert-info">

                            <strong>Price</strong>

                            <br>

                            रु. <span id="price">0.00</span>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="alert alert-warning">

                            <strong>Available Stock</strong>

                            <br>

                            <span id="stock">0</span>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="alert alert-success">

                            <strong>Total Price</strong>

                            <br>

                            रु. <span id="total">0.00</span>

                        </div>

                    </div>

                </div>

                <button class="btn btn-success">

                    <i class="fas fa-check"></i>

                    Place Order

                </button>

                <a href="{{ route('orders.index') }}"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

<script>

function calculateTotal(){

    let medicine=document.getElementById('medicineSelect');

    let option=medicine.options[medicine.selectedIndex];

    let price=parseFloat(option.dataset.price);

    let stock=option.dataset.stock;

    let qty=parseInt(document.getElementById('quantity').value);

    document.getElementById('price').innerHTML=price.toFixed(2);

    document.getElementById('stock').innerHTML=stock;

    document.getElementById('total').innerHTML=(price*qty).toFixed(2);

}

document.getElementById('medicineSelect').addEventListener('change',calculateTotal);

document.getElementById('quantity').addEventListener('keyup',calculateTotal);

document.getElementById('quantity').addEventListener('change',calculateTotal);

calculateTotal();

</script>

@endsection