@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Entity</div>

                    <div class="panel-body">
                            {!! Form::open(['url' => 'home/entity/create']) !!}
                                @include('entities._form', ['submitLabel' => 'Create', 'create' => true])
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop