@extends('layouts.app')

@section('content')
    @php
        use App\Models\Account;
    @endphp
    <div class="d-flex justify-content-center" style="height: auto; width:auto; max-width:1000px; margin:auto;">
        <div class="payments row justify-content-center" style="width:100%;">
            <div class="payment-text-sec d-block justify-content-center" style="padding: 0px 50px;">
                <div class="payment-info">
                    <p class="payment-info-text">Chuyển khoản đến {{ PAYMENT_METHOD_NAME[$paymentMethod->payment_id] }}</p>
                </div>

                <div class="payment-info">
                    <p class="payment-info-title">Số tài khoản:</p>
                    <span class="d-flex justify-content-start">
                        <p class="payment-info-text" id="bankAccountNumber">{{ $paymentMethod->bank_account_number }}</p>
                        &emsp;<i class="fa-solid fa-copy fa-xl copy-icon" onclick="copyText('bankAccountNumber')"></i>
                    </span>
                </div>

                <div class="payment-info">
                    <p class="payment-info-title">Người thụ hưởng:</p>
                    <span class="d-flex justify-content-start">
                        <p class="payment-info-text" id="bankAccountName">{{ $paymentMethod->name_receiver }}</p>&emsp;<i
                            class="fa-solid fa-copy fa-xl copy-icon" onclick="copyText('bankAccountName')"></i>
                    </span>
                </div>

                <div class="payment-info">
                    <p class="payment-info-title">Nội dung:</p>
                    <span class="d-flex justify-content-start">
                        <p class="payment-info-text" id="bankAccountContent">{{ $checkoutCode }}</p>&emsp;<i
                            class="fa-solid fa-copy fa-xl copy-icon" onclick="copyText('bankAccountContent')"></i>
                    </span>
                </div>

                <div class="payment-info">
                    <p class="payment-info-title">Số tiền cần thanh toán:</p>
                    <span class="d-flex justify-content-start">
                        <p class="payment-info-text" id="paymentMoney">{{ $paymentMoney }}</p>VND&emsp;<i
                            class="fa-solid fa-copy fa-xl copy-icon" onclick="copyText('paymentMoney')"></i>
                    </span>
                </div>

                <div class="payment-info">
                    <p class="payment-info-title">Thời gian chờ thanh toán:</p>
                    <div class="payment-info-text" id="timer">15:00</div>
                </div>

                <div class="payment-info">
                    <p class="payment-info-title">Lưu ý: Chuyển khoản với nội dung đúng với nội dung đã nêu ở trên.</p>
                </div>

                <div class="payment-info">
                    <span class="d-flex justify-content-start">
                        <div class="four-dots" style="height:30px; width: 30px; margin:5px 0px;"></div><span>Đang đợi thanh
                            toán</span>
                    </span>
                </div>

            </div>

            <div class="payment-qr-sec d-flex justify-content-center" style="padding: 0px 50px;">
                <img src="{{ $paymentMethod->qr_url }}" style="width:100%; height: 300px;">
            </div>




        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/sass/payment.scss', 'resources/js/bootstrap.js'])
@endsection

@section('script2')
    <script type="text/javascript">
        window.history.pushState({
            page: 1
        }, "", "");

        window.onpopstate = function(event) {
            if (event) {
                window.location.href = `{{ route('checkout.checkoutTimeOut', '') }}` + "/" +
                        {{ $checkoutId }};
                console.log('back btn clicked');
                // Code to handle back button or prevent from navigation
            }
        }

        function copyText(id) {
            var copyText = document.getElementById(id).textContent;

            /* Create a temporary textarea element to hold the text */
            var tempTextArea = document.createElement("textarea");
            tempTextArea.value = copyText;
            document.body.appendChild(tempTextArea);

            /* Select the text in the temporary textarea */
            tempTextArea.select();

            /* Copy the text inside the temporary textarea to the clipboard */
            document.execCommand("copy");

            /* Remove the temporary textarea from the page */
            document.body.removeChild(tempTextArea);

        }

        $(document).ready(function() {
            /* Set the starting time to 15 minutes */
            var time = 900;

            /* Define a function to update the timer every second */
            var countdown = setInterval(function() {
                /* Convert the time to minutes and seconds */
                var minutes = Math.floor(time / 60);
                var seconds = time % 60;

                /* Add leading zeros to the minutes and seconds if necessary */
                minutes = (minutes < 10) ? "0" + minutes : minutes;
                seconds = (seconds < 10) ? "0" + seconds : seconds;

                /* Update the timer element with the new time */
                $("#timer").html(minutes + ":" + seconds);

                /* Decrement the time */
                time--;

                /* Stop the countdown when the time reaches 0 */
                if (time < 0) {
                    clearInterval(countdown);
                    window.location.href = `{{ route('checkout.checkoutTimeOut', '') }}` + "/" +
                        {{ $checkoutId }};
                }
            }, 1000);


        });


        const channelName = 'public.payment.' + '{{ $checkoutCode }}';
        const redirectRoute = `{{ route('checkout.checkoutComplete', '') }}` + "/" + {{ $checkoutId }};
        const waitingPayment = true;
    </script>
@endsection
