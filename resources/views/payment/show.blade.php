@extends('layouts.app')

@section('container')
    <main class="min-h-screen px-14 py-28 flex flex-col gap-4">
        <div class="flex justify-between">
            <div class="w-1/2">
                <div class=" flex justify-between pb-10">
                    <h1 class="text-7xl font-bold text-neutral-600">PAYMENT</h1>
                    <span
                        class=" flex items-center px-20 text-2xl font-bold text-white uppercase rounded-full {{ $payment->status === 'paid' ? 'bg-green-500' : 'bg-red-500' }}">{{ $payment->status }}</span>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex justify-between">
                        <span>PAYMENT-ID</span>
                        <span class="font-semibold">{{ $payment->payment_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Created At</span>
                        <span>{{ $payment->created_at }}</span>
                    </div>
                    @if ($payment->status === 'paid')
                        <div class="flex justify-between">
                            <span>Confirmation At</span>
                            <span>{{ $payment->updated_at }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span>Guest</span>
                        <span>{{ $payment->guest }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Layout</span>
                        <span>{{ $payment->layout }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Event Name</span>
                        <span>{{ $payment->event->title }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Total Price</span>
                        <span class="text-xl font-bold">Rp{{ number_format($payment->total_price, 2, '.', '.') }}</span>
                    </div>

                    @if ($payment->status === 'unpaid')
                        <button id="pay-button"
                            class="w-fit px-14
                py-2 rounded-full bg-green-500 text-white hover:opacity-70 mt-20">Payout
                            Now</button>
                    @endif
                </div>
            </div>
        </div>
    </main>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_SERVER_KEY') }}"></script>
    <script>
        function copyText(value) {
            copyText = value;
            // Select the text field
            // copyText.select();
            // copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText);

            alert('Berhasil di salin!');
        }

        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from the previous step
            snap.pay('{{ $payment->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    // Create the dynamic URL with the required parameters
                    let url =
                        "{{ route('payments.confirm', ['payment_id' => $payment->payment_id, 'status' => ':status', 'order_id' => ':order_id']) }}"
                        .replace(':status', 200).replace(':order_id', result.order_id);

                    console.log(url)

                    // Send the AJAX request
                    $.ajax({
                        type: 'post',
                        url: url,
                        data: JSON.stringify({
                            '_token': '{{ csrf_token() }}'
                        }),
                        contentType: 'application/json',
                        success: function(data) {
                            window.location.href = data.redirectUrl;
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                },
                // Optional
                onPending: function(result) {
                    // Handle pending result
                },
                // Optional
                onError: function(result) {
                    // Handle error result
                }
            });
        };
    </script>
@endsection
