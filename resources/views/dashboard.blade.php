@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-8 mx-auto">
                        <div class="login d-flex align-items-center py-5">
                            <div class="visible-print text-center">
                                @if($json !="")
                                    {!! QrCode::size(300)->generate($json); !!}

                                    <p>Scan me to return to the original page.</p>
                                @else
                                    <a href="{{url('post-qr')}}">
                                        <div class="btn btn-dark">
                                            Продлить\получить пропуск
                                        </div>
                                    </a>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="login-heading mb-4">Welcome Dashboard!</h3>
                            <div class="card">
                                <div class="card-body">
                                    Welcome {{ ucfirst(Auth()->user()->name) }}
                                </div>
                                <div class="card-body">
                                    <a class="small" href="{{url('logout')}}">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
