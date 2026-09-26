@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 text-center">
                    <img src="https://cdn.esewa.com.np/ui/images/esewa__logo.png"
                         alt="eSewa"
                         style="height:42px;"
                         class="mb-3">

                    <h3>Continue with eSewa</h3>
                    <p class="text-muted">You are being redirected to the eSewa UAT payment page.</p>

                    <form action="{{ config('services.esewa.endpoint') }}" method="POST" id="esewa-form">
                        <input type="hidden" name="amount" value="{{ $totalAmount }}">
                        <input type="hidden" name="tax_amount" value="0">
                        <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
                        <input type="hidden" name="transaction_uuid" value="{{ $transactionUuid }}">
                        <input type="hidden" name="product_code" value="{{ config('services.esewa.product_code') }}">
                        <input type="hidden" name="product_service_charge" value="0">
                        <input type="hidden" name="product_delivery_charge" value="0">
                        <input type="hidden" name="success_url" value="{{ route('payment.esewa.success') }}">
                        <input type="hidden" name="failure_url" value="{{ route('payment.esewa.failure') }}">
                        <input type="hidden" name="signed_field_names" value="{{ $signedFields }}">
                        <input type="hidden" name="signature" value="{{ $signature }}">

                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            Pay रु. {{ number_format($totalAmount, 2) }} with eSewa
                        </button>
                    </form>

                    <small class="d-block text-muted mt-3">eSewa UAT / test environment</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('esewa-form').submit();
</script>
@endsection