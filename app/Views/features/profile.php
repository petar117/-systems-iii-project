<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                             alt="avatar"
                             class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3"><?php echo session()->get('username') ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">First Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo session()->get('firstName') ?>
                                    <a class="float-end"><i class="fa-solid fa-pen-to-square"></i></a>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Last Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo session()->get('lastName') ?>
                                    <a class="float-end"><i class="fa-solid fa-pen-to-square"></i></a>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo session()->get('email') ?>
                                    <a class="float-end"><i class="fa-solid fa-pen-to-square"></i></a>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo session()->get('phoneNumber') ?>
                                    <a class="float-end"><i class="fa-solid fa-pen-to-square"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                        <h5 class="text-center">Favourites</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                        <h5 class="text-center">My Items</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                        <h5 class="text-center">My Orders</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="float" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa fa-plus my-float"></i>
        <span class="text">Add New Item</span>
    </a>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="greski" hidden>
                    </div>
                    <form enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="itemName">Item Name</label>
                            <input type="text" class="form-control" name="itemName" id="itemName"
                                   placeholder="Item Name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Item Description</label>
                            <input type="text" class="form-control" name="description" id="description"
                                   placeholder="Item Description" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Item Price</label>
                            <input type="text" class="form-control" name="price" id="price" placeholder="Item Price"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload item image</label>
                            <input class="form-control" type="file" name="file" accept="image/*" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function () {

        $('form').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: 'post',
                url: '/features/addItem',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response === "ok") {
                        alert("Upload Successful!");
                        location.reload()
                    } else {
                        document.getElementById("greski").hidden = false;
                        $('#greski').html(response);
                    }
                },
                error: function (result) {
                    $('body').html("err");
                },
            });

        });

    });
</script>

