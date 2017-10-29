@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Budget Type</div>

                    <div class="panel-body">
                        {!! Form::model($budget_type, ['method' => 'PATCH',  'url' => ['home/budget_types', $budget_type->id], 'id' => 'form-budget_type']) !!}
                            @include('budget_types._form', ['submitLabel' => 'Edit', 'create' => false])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop