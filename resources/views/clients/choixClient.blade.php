@extends('layouts.app')

@section('title','Choisir un client')

@section('content')
    <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/select2.full.min.js')}}"defer></script>
    <script src="{{asset('js/select2.fr.js')}}"defer></script>
    <div id="choixClient" class="factureBloc">
        <!--<div class="row">
            <div class="col-xs-12 col-sm-4 text-center">
                <div href="#" class="well icon_case icon_case_editable" title="Choisir un autre utilisateur">
                    <i class="fa fa-user-circle fa-4x"></i>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8">
                <p>client</p>
            </div>
        </div>-->
        {!! Form::open(['autocomplete'=>"off",'class'=>'form-min-height','id'=>"formChoixClient"]) !!}
            <div class="form-group col-md-6 {{ ($errors->has('client_id'))?'has-error':''}}">
                {!! Form::label('client_id', 'Client',['class'=> 'control-label']) !!}
                {!! Form::select('client_id',[],'',['placeholder' => 'Choisissez un client','class' => 'form-control']) !!}
                <div class="control-feedback">{{ ($errors->has('client_id'))?$errors->first('client_id'):''}}</div>
            </div>
            <div class="col-md-12 text-center">
                {!! Form::submit('Enregistrer',['class' => 'btn btn-success','id'=>'submitBoutton']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <script>
        $(function(){

            $('#client_id').select2({
                language: "fr",
                allowClear: true,
                delay: 250, // wait 250 milliseconds before triggering the request
                minimumInputLength: 2,
                placeholder: "Selectionner un client",
                ajax: {
                    url: '{{ route('clients.getClients') }}',
                    data: function (params) {
                        searchParam = params;
                        var query = {
                            search: params.term,
                            page: params.page || 1,
                        };
                        // Query parameters will be ?search=[term]&page=[page]
                        return query;
                    },
                    dataType:'json',
                    processResults: function (data) {
                        var word = searchParam.term;
                        if (data.results.length == 0 && searchParam.term) {
                            data.results.push({
                                id:  word,
                                text: 'ajouter nouveau client '+ word,
                                newClient : true,
                            });
                        }
                        return data;
                    }
                },
            }).on("select2:select", function (e) {
                var article = e.params.data;
                if(article.newClient){
                    window.location.replace('{{route('clients.add')}}');
                }
            });
        });
    </script>
@endsection