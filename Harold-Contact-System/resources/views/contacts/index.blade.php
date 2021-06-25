@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome to Harold Contacts') }}

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left mt-3">
                                <h2>Contacts </h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success mb-5" href="{{ route('contacts.create') }}" title="Create a contact"> <i class="fas fa-plus-circle"></i>
                                    Create Contact
                                </a>
                            </div>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p></p>
                        </div>
                    @endif

                    <div class="w-full sm:w-8/12 mb-3">
                        <form>
                            <div class="sm:ml-3 flex">
                                <input class="w-full p-2 ml-0" name="search" type="text" placeholder="Search" value="{{ request()->input('search') }}">
                                <button class="flex items-center justify-end w-auto p-2 text-blue-500">
                                    <i class="fas fa-fa-search">search</i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <table class="table table-bordered table-responsive-lg">
                        <tr>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        @foreach (Auth::user()->contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }} </td>
                                <td>{{ $contact->company }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline leading-4" @submit="if( !confirm('Are sure you want to delete this?') ) $event.preventDefault();"" method="POST">

                                        <a href="{{ route('contacts.edit', $contact->id) }}">
                                            <i class="fas fa-edit  fa-lg"> Edit</i>
                                        </a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" title="delete"  onclick="return confirm('Are you sure you want to delete this contact?')" style="border: none; background-color:transparent;">
                                            <i class="fas fa-trash fa-lg text-danger"> Delete</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
