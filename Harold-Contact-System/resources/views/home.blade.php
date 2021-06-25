@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Thank you For Registering') }}

                    <div>
                            <div class="pull-right">
                                <a class="btn btn-success mb-5" href="{{ route('contacts.index') }}" title="Create a contact"> <i class="fas fa-plus-circle"></i>
                                    Continue
                                </a>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
