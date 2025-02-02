@extends('tiyya.index')
@section('content')
<head><title>
    acount
</title></head>
    <style>
        .centred {
            padding-top: 50px;
            text-align: center;
            
        }

        .bodyContainer {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding-top: 20px;
            /* Add some space between the columns */
        }

        .left,
        .right {
            width: 48%;
            /* Make sure both columns take almost equal space */
        }

        /* Optional: to make sure the body container adjusts well on smaller screens */
        @media (max-width: 768px) {
            .bodyContainer {
                flex-direction: column;
                align-items: center;
            }

            .left,
            .right {
                width: 100%;
                /* Stack the columns on smaller screens */
            }
        }
    </style>
    <div class="page-width page-content">
        <header class="centred">
            <h1 class="centred" style="font-size: 45px;">@lang('account.my_account')</h1>
            <a href="{{route('user.logout')}}" class="btn btn--secondary btn--small section-header__link">@lang('account.sign_out')</a>
        </header>

        <div class="bodyContainer" >
            <div class="left">
                <h2 style="font-size: 20px;">@lang('account.order_history')</h2>
                <p>@lang('account.no_order_yet')</p>
            </div>

            <div class="right ">
                <h3 style="font-size: 20px;">@lang('account.account_details')</h3>
                <p class="h5">{{$user->email}}</p>
                <p> {{$user->name}} <br>@lang('account.mauritania')</p>
                <p><a href="/account/addresses" class="text-link">{{ $user->address}}</a></p>
            </div>


        </div>
    </div>
@endsection