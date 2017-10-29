@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Budget Type for entity "{{ $entity->organization_name}}"</div>

                    <div class="panel-body">
                            {!! Form::open(['url' => 'home/budget_types/create']) !!}
                                @include('budget_types._form', ['submitLabel' => 'Create', 'create' => true])
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop