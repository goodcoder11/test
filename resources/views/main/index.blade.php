@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">{{ __('Start creating your tasks!') }}</div>

                <div class="card-body">
                    @if(session('message'))
                        <p class="alert alert-success">{{ session('message') }}</p>
                    @endif

                    @if(!empty($errors->all()))
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="post" action="{{ route('create-task') }}">
                        @csrf

                        <div class="form-group">
                            <label>Your Name*</label>
                            <input type="text" name="user_name"
                                   value="{{ old('user_name', auth()->check() ? auth()->user()->name : null) }}" required
                                   class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label>Email*</label>
                            <input type="email" name="email"
                                   value="{{ old('email', auth()->check() ? auth()->user()->email : null) }}" required
                                   class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label>Task Description*</label>
                            <textarea minlength="2" required name="text"
                                      class="form-control">{{ old('text') }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="float-right">
                                <button type="submit" class="btn btn-lg btn-primary">Save Task</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('includes.tasks-section')
    </div>
@endsection
