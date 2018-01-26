@extends('layouts.app')

@section('title','Créer une facture')

@section('content')
    <div id="addFacture" class="factureBloc">
        <div class="row">
            <div class="col-xs-12 col-sm-4 text-center">
                <div href="#" class="well icon_case icon_case_editable" title="Choisir un autre utilisateur">
                    <i class="fa fa-user-circle fa-4x"></i>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8">
                <p>client</p>
            </div>
        </div>
    </div>
@endsection