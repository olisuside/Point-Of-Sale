<div class="modal fade text-left modal-borderless" id="modal-form" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33"></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="modal-body form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>

                        <div class="col-md-8 form-group">
                            <input type="text" name="name" id="name" placeholder="Nama User" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Username</label>
                        </div>

                        <div class="col-md-8 form-group">
                            <input type="text" name="username" id="username" placeholder="Username" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Email</label>
                        </div>

                        <div class="col-md-8 form-group">
                            <input type="text" name="email" id="email" placeholder="Email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Password</label>
                        </div>

                        <div class="col-md-8 form-group">
                            <div class="input-group">
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control" required minlength="6">
                            <a class="btn icon btn-secondary" onclick="myFunction('password')">
                                <i class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Konfirmasi Password</label>
                        </div>

                        <div class="col-md-8 form-group">
                            <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password" class="form-control" required data-match='#password'>
                            <a class="btn icon btn-secondary" onclick="myFunction('password_confirmation')">
                                <i class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block submit-text"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>