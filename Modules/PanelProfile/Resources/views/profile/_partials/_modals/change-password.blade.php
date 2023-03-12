<!-- Edit User Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Change Password</h1>
                </div>
                {{-- <form class="row gy-1 pt-75"> --}}
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Current Password</label>
                            <input type="password" id="current_pass" class="form-control" value="" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Password</label>
                            <input type="password" id="new_pass" class="form-control" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" id="confirm_pass" class="form-control" />
                        </div>
                        <div class="col-12 mt-2 pt-50">
                            <button type="submit" id="changePassBtn" class="btn btn-primary me-1">Change Password
                            </button>
                        </div>
                    </div>
                    {{--
                </form> --}}
            </div>
        </div>
    </div>
</div>
<!--/ Edit User Modal -->