@extends('layouts.app')

@section('content')
    @php
        use App\Models\Account;
    @endphp
    <div class="d-flex justify-content-center" style="height: auto; width:auto; max-width:1000px; margin:auto;">
        <div class="row justify-content-center" style="width:100%;">
            <div class="d-block justify-content-center" style="padding: 0px 50px;">
                <form method="post" action="{{route('checkout.paymentAccept')}}"> @csrf
                    <input type="text" name="code"/>
                    <input type="text" name="money"/>

                    <button type="submit">Submit</button>
                </form>


            </div>




        </div>
    </div>
@endsection


