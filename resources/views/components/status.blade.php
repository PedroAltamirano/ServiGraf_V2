<!-- STATE MODAL -->
@if(session('actionStatus'))
{{session('actionStatus')}}
<div class="modal fade modal-status" id="actionStatusModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ json_decode(session('actionStatus'))->title }}</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            @if(json_decode(session('actionStatus'))->type == 'success')
            <i class="far fa-check-circle fa-10x text-success w-100 text-center"></i>
            @elseif(json_decode(session('actionStatus'))->type == 'danger')
            <i class="far fa-times-circle fa-10x text-danger w-100 text-center"></i>
            @else
            <i class="far fa-question-circle fa-10x text-{{json_decode(session('actionStatus'))->type}} w-100 text-center"></i>
            @endif
            <div class="dropdown-divider"></div>
            <span class="text-{{json_decode(session('actionStatus'))->type}}">
            {{ json_decode(session('actionStatus'))->message }}
            </span>
        </div>
        </div>
    </div>
</div>
@endif