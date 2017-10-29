        <div class="form-group">
            {!! Form::label('budget_name', 'Name*') !!}
            {!! Form::text('budget_name', null, ['class' => 'form-control']) !!}
        </div>
    
        @if(isset($entity))
            <div class="form-group">
                {!! Form::hidden('entity_id', $entity->id, ['class' => 'form-control']) !!}
            </div>
        @endif

        <div class="form-group">
            {!! Form::submit($submitLabel, ['class' => 'btn btn-success']) !!}
            @if ($create === false)
                <a class="btn btn-primary" href="/home/{{  $budget_type->entity_id }}/{{  $budget_type->id }}" value="Cancel">Cancel</a>
            @else 
                <a class="btn btn-primary" href="/home" value="Cancel">Cancel</a>
            @endif
        </div>


        @section('footer')

        @stop
