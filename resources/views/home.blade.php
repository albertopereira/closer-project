@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Entity</strong>
                        @if($entity)
                            {!! Form::open(array(
                                'class' => 'form-inline form-confirm header-form',
                                'data-title' => 'Confirmation',
                                'data-text' => 'Are you sure you want to delete ' . '"' . $entity->organization_name . '"?',
                                'method' => 'DELETE',
                                'route' => array('entities.destroy', $entity->id)))
                            !!}
                                <a class="btn pull-right btn-xs btn-danger confirmActionForm">Remove entity</a>
                            {!! Form::close() !!}    
                            <a href="/home/entity/{{ $entity->id }}" class="btn pull-right btn-xs btn-primary">Edit entity</a>
                        @endif
                            <a href="/home/entity/create" class="btn pull-right btn-xs btn-success">New entity</a>
                    
                
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
    
                    @if(count($entities) === 0)
                        <p>No entities yet.</p>
                    @else                
                        <select class="form-control" id="entitySelector">
                            @foreach ($entities as $ent)
                                <option class="form-control" value="{{  $ent->id }}" 
                                    @if($ent->id === $entity->id) 
                                     selected
                                    @endif
                                >{{ $ent->organization_name }}</option>
                            @endforeach                        
                        </select>

                        <table class="entity-details">
                            <tr>
                                <td>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th> Country</th>
                                            <td id="entity_country">
                                                {{ $entity->country }}
                                            </td>
                                            <th> State</th>
                                            <td id="entity_state">
                                                {{ $entity->state }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Org. Name</th>
                                            <td id="entity_org_name">
                                                {{ $entity->organization_name }}
                                            </td>
                                            <th> Agency Name</th>
                                            <td id="agency_name">
                                                {{ $entity->agency_name }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th> Org. Url</th>
                                            <td id="entity_org_url">
                                                {{ $entity->organization_url }}
                                            </td>
                                            <th> Agency Url</th>
                                            <td id="agency_url">
                                                {{ $entity->agency_url }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th> Org. Email</th>
                                            <td id="entity_org_email">
                                                {{ $entity->organization_email }}
                                            </td>
                                            <th> Agency Email</th>
                                            <td id="agency_email">
                                                {{ $entity->agency_email }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>                            
                            </tr>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if(count($entities) !== 0)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Budget Type</strong>
                            @if($budget_type !== null)
                                {!! Form::open(array(
                                    'class' => 'form-inline form-confirm header-form',
                                    'data-title' => 'Confirmation',
                                    'data-text' => 'Are you sure you want to delete ' . '"' . $budget_type->budget_name . '"?',
                                    'method' => 'DELETE',
                                    'route' => array('budget_types.destroy', $budget_type->id)))
                                !!}
                                    <a class="btn pull-right btn-xs btn-danger confirmActionForm">Remove budget type</a>
                                    <a href="/home/budget_types/{{ $budget_type->id }}" class="btn pull-right btn-xs btn-primary">Edit budget type</a>
                                    <a href="/home/budget_types/create/{{ $entity->id }}" class="btn pull-right btn-xs btn-success">New budget type</a>
                                {!! Form::close() !!}
                            @else 
                                <a href="/home/budget_types/create/{{ $entity->id }}" class="btn pull-right btn-xs btn-success">New budget type</a>
                            @endif
                    
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        @if(count($budget_types) === 0)
                            <p>No budgets yet.</p>
                        @else
                            <select class="form-control" id="budgetSelector">
                                @foreach ($budget_types as $bt)
                                    <option class="form-control" value="{{  $bt->id }}" 
                                        @if($bt->id === $budget_type->id) 
                                         selected
                                        @endif
                                    >{{ $bt->budget_name }}</option>
                                @endforeach                        
                            </select>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
    @if(count($budget_types) !== 0)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Data <a href="/view/{{ $budget_type->id }}" target="_blank">(view page)</a></strong>
                        {!! Form::open(['route' => array('budget_types.updateData', $budget_type->id), 'class' => 'form-inline form-confirm header-form']) !!}
                            <button id="saveData" class="btn pull-right btn-xs btn-success">Save</button>
                            <input type="hidden" name="data" id="formattedJSON">
                        {!! Form::close() !!}
                        <button id="addLevel" class="btn pull-right btn-xs btn-primary">Add level</button>
                        <button id="removeLevel" class="btn pull-right btn-xs btn-primary">Remove level</button>
                        <button id="addYear" class="btn pull-right btn-xs btn-primary">Add Year</button>  
                        <button id="removeYear" class="btn pull-right btn-xs btn-primary">Remove Year</button>
                        
                    
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body data-content">
                        <div id="data-content"></div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            @if($budget_type->data !== null)
                var jsonData = JSON.parse('{!! $budget_type->data !!}')
            @else
                // default values 
                var jsonData = JSON.parse('{"key": "", "descr": "", "src": "", "hash": "", "coords": "", "values":[],"sub": [{"key":"","descr":"","hash":"","values":[{"year": 2017, "val": 0}]}]}')
            @endif
        </script>
    @endif
@endsection