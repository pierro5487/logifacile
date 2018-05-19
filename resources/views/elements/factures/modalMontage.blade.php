<div id="modalMontage" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-life-ring"></i>
                    Ajouter un montage
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="modalMontageErreur" class="col-xs-12">

                    </div>
                    <div class="col-xs-12">
                        <form>
                            <div class="form-group col-xs-12">
                                <h3>Montage/Equilibrage/Valve</h3>
                                <div class="col-xs-6">
                                    <label for="equilibrage">Equilibrage</label>
                                    <input id="equilibrage" type="checkbox" name="equilibrage" value="equilibrage" checked/>
                                </div>
                                <div class="col-xs-6">
                                    <label for="valve">Valve</label>
                                    <input id="valve" type="checkbox" name="valve" value="valve" checked/>
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
                                <h3>Taille Jante</h3>
                                <div class="row">
                                    @for($i = 14;$i < 23;$i++)
                                        <div class="col-xs-1 text-center">
                                            <label for="size{{$i}}">{{$i}}"</label>
                                            <input id="size{{$i}}" type="radio" name="size" value="{{$i}}"/>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
                                <h3>Quantite</h3>
                                <select id="montageQuantite" name="quantite" class="form-control col-xs-12 col-sm-6">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12">
                                <h3>Situation Montage</h3>
                                <div class="col-xs-4">
                                    <label for="situationAV">AV</label>
                                    <input id="situationAV" type="radio" name="situation" value="AV"/>
                                </div>
                                <div class="col-xs-4">
                                    <label for="situationAR">AR</label>
                                    <input id="situationAR" type="radio" name="situation" value="AR"/>
                                </div>
                                <div class="col-xs-4">
                                    <label for="situationAVAR">AV & AR</label>
                                    <input id="situationAVAR" type="radio" name="situation" value="AVAR"/>
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
                                <h3>Options</h3>
                                <div class="form-group col-xs-4">
                                    <label for="alu">Alu</label>
                                    <input id="alu" type="checkbox" name="alu" value="alu"/>
                                </div>
                                <div class="form-group col-xs-4">
                                    <label for="runflat">Runflat</label>
                                    <input id="runflat" type="checkbox" name="runflat" value="runflat"/>
                                </div>
                                <div class="form-group col-xs-4">
                                    <label for="truck">Camionette</label>
                                    <input id="truck" type="checkbox" name="truck" value="truck"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button id="addMontageButton" type="button" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){

        addMontageBtn = $('#addMontageButton');
        modalMontageErreur = $('#modalMontageErreur');

        addMontageBtn.on('click',function(){
            modalMontageErreur.empty();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            setAjaxLoaderFullPage(true,'enregistrement en cours');

            $.ajax({
                url:'{{route('ligneFactures.addMontage')}}',
                dataType:'json',
                type:'post',
                data:{
                    idFacture : idFacture,
                    idGroupe : idGroupeEnCours,
                    equilibrage : $('#equilibrage').prop('checked'),
                    valve : $('#valve').prop('checked'),
                    size : $('[name="size"]:checked').val(),
                    situation : $('[name="situation"]:checked').val(),
                    alu : $('#alu').prop('checked'),
                    runflat : $('#runflat').prop('checked'),
                    truck : $('#truck').prop('checked'),
                    quantite : $('#montageQuantite').val()
                },
                success:function(res){
                    console.log(res.success);
                    if(typeof(res.success) != 'undefined'){
                        console.log('ici');
                        if(res.success){
                            //sweet alert ok
                            addLigneToGroupe(idGroupeEnCours,res.ligne,res.sousTotalGroupe);
                            updateTotaux(res.totaux);
                            $('#modalMontage').modal('hide');
                        }else{
                            alert(res.message);
                        }
                    }else{
                        //on affiche la liste d'erreurs
                        console.log(res);
                        modalMontageErreur.empty().append(formatListeErreur(res));
                    }
                },
                error:function(){
                    //erreur prioduite
                    alert('Une erreur s\'est produite');
                },
                complete:function(){
                    setAjaxLoaderFullPage(false);
                }
            });
        });
    })
</script>