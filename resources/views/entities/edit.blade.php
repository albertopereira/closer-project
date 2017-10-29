@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Entity</div>

                    <div class="panel-body">
                        {!! Form::model($entity, ['method' => 'PATCH',  'url' => ['home/entity', $entity->id], 'id' => 'form-entity']) !!}
                            @include('entities._form', ['submitLabel' => 'Edit', 'create' => false])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop