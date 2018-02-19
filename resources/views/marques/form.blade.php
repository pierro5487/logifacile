<div class="row">
    {!! Form::token() !!}
    <div class="form-group col-md-6 {{ ($errors->has('marque'))?'has-error':''}}">
        {!! Form::label('marque', 'Marque',['class'=> 'control-label']) !!}
        {!! Form::text('marque',isset($marque)?$marque->nom:'',['class' => 'form-control','required']) !!}
        <div class="control-feedback">{{ ($errors->has('marque'))?$errors->first('marque'):''}}</div>
    </div>
    <div class="col-xs-12 text-center">
        {!! Form::submit('Enregistrer',['class' => 'btn btn-success','id'=>'submitBoutton']) !!}
    </div>
</div>