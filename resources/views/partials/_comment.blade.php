@if($user->hasRole(\App\Autorisation::DIRECTEUR) || $user->hasRole(\App\Autorisation::RBOM) || $user->hasRole(\App\Autorisation::RTM) || $user->hasRole(\App\Autorisation::CIE) )
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-comments-o"></i> Commenter </button>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="{{route('nouveau_commentaire')}}" method="post">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">Notification du planning</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" placeholder="Veuillez saisir votre commentaire pour ce planning"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif