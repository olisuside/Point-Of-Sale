@extends('layouts.app')

@section('title', 'Penjualan')

@push('css')
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{config('midtrans.client_key')}}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
@endpush

@section('contents')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Detail Pesanan</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-5">
                            <div class="row">
                                <div class="col-3">
                                    <span>ID Member</span>
                                </div>
                                <div class="col-3">
                                    <span>: {{ $penjualan->member->kode_member ?? '' }}</span>
                                </div>
                                <div class="col-3">
                                    <span>Total Item</span>
                                </div>
                                <div class="col-3">
                                    <span>: {{ $penjualan->total_item}}</span>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <span>Nama Member</span>
                                </div>
                                <div class="col-3">
                                    <span>: {{ $penjualan->member->nama ?? '' }}</span>
                                </div>
                                <div class="col-3">
                                    <span>Diskon</span>
                                </div>
                                <div class="col-3">
                                    <span>: {{ $penjualan->diskon }}</span>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <span>Total Harga</span>
                                </div>
                                <div class="col-3">
                                    <span>: {{ $penjualan->total_harga }}</span>
                                </div>
                                <div class="col-3">
                                    <span>Total Bayar</span>
                                </div>
                                <div class="col-3">
                                    <span>: {{ $penjualan->bayar }}</span>
                                </div>
                            </div>
                        </div>
                            <div class="col-sm-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary me-1 mb-1" id="pay-button">Bayar</button>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




@push('scripts')
    <script>// For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay('{{$snapToken}}', {
            onSuccess: function(result){
              /* You may add your own implementation here */
              alert("payment success!"); console.log(result);
            },
            onPending: function(result){
              /* You may add your own implementation here */
              alert("wating your payment!"); console.log(result);
            },
            onError: function(result){
              /* You may add your own implementation here */
              alert("payment failed!"); console.log(result);
            },
            onClose: function(){
              /* You may add your own implementation here */
              alert('you closed the popup without finishing the payment');
            }
          })
        });</script>
@endpush
