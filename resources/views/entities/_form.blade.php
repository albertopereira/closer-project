        <div class="form-group">
            {!! Form::label('organization_name', 'Organization Name*') !!}
            {!! Form::text('organization_name', null, ['class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('organization_url', 'Organization URL') !!}
            {!! Form::text('organization_url', null, ['class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('organization_email', 'Organization Email') !!}
            {!! Form::text('organization_email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('agency_name', 'Agency Name') !!}
            {!! Form::text('agency_name', null, ['class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('agency_url', 'Agency URL') !!}
            {!! Form::text('agency_url', null, ['class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('agency_email', 'Agency Email') !!}
            {!! Form::text('agency_email', null, ['class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('country', 'Country') !!}
            {!! Form::text('country', null, ['class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('state', 'State') !!}
            {!! Form::text('state', null, ['class' => 'form-control']) !!}
        </div>
    

        <div class="form-group">
            {!! Form::submit($submitLabel, ['class' => 'btn btn-success']) !!}
            @if ($create === false)
                <a class="btn btn-primary" href="/home/{{  $entity->id }}" value="Cancel">Cancel</a>
            @else 
                <a class="btn btn-primary" href="/home" value="Cancel">Cancel</a>
            @endif
        </div>


        @section('footer')

        @stop
