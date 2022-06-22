<div id="modalAddGroupMembers" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title">
                    <i class="ti-user"></i>{{__('messages.chats.add_members')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                @livewire('search-group-members-for-edit-group')
                <button class="btn btn-success mt-1 btn-add-members-to-group pull-right mt-3" data-group-id=""
                        data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                    {{__('messages.chats.add_to_group')}}
                </button>
            </div>
        </div>
    </div>
</div>
