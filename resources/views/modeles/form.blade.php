<div class="row">
    {!! Form::token() !!}
    <div class="form-group col-md-6 {{ ($errors->has('marque_id'))?'has-error':''}}">
        {!! Form::label('marque_id', 'Marque',['class'=> 'control-label']) !!}
        {!! Form::select('marque_id',$marques,isset($modele)?$modele->marque_id:'',['placeholder' => 'Choisissez une marque de véhicule','class' => 'form-control','required']) !!}
        <div class="control-feedback">{{ ($errors->has('marque_id'))?$errors->first('marque_id'):''}}</div>
    </div>
    <div class="form-group col-md-6 {{ ($errors->has('modele'))?'has-error':''}}">
        {!! Form::label('modele', 'Modèle',['class'=> 'control-label']) !!}
        {!! Form::text('modele',isset($modele)?$modele->nom:'',['class' => 'form-control','required']) !!}
        <div class="control-feedback">{{ ($errors->has('modele'))?$errors->first('modele'):''}}</div>
    </div>
    <div class="col-xs-12 text-center">
        {!! Form::submit('Enregistrer',['class' => 'btn btn-success','id'=>'submitBoutton']) !!}
    </div>
</div>