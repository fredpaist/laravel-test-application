@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Please enter your name and pick the Sectors you are currently involved in.') }}</div>

                    <div class="card-body">

                        @if(count($errors) >= 1)
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->all() as $error)
                                    {!! $error !!}<br>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('save') }}">
                             @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" value="{{ ($saved ? $saved->name : '') }}" id="name" name="name" placeholder="Enter Name">
                            </div>

                            <div class="form-group">
                                <label for="sectors">Sectors:</label>
                                <select multiple="multiple" size="5" class="form-control" id="sectors" name="sectors[]">
                                    @foreach($sectors as $sector)
                                        <option value="{{ $sector['value'] }}" {{ $sector['selected'] ? 'selected' : '' }}>
                                            {!! (str_repeat('&nbsp;', $sector['level'] * 4)).$sector['name']  !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" {{ ($saved ? 'checked' : '') }} class="form-check-input" id="terms" name="terms">
                                <label class="form-check-label" for="terms">Agree to terms</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection