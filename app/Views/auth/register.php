<section class="vh-100 gradient-custom" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                        <div class="alert alert-danger" id="greski" hidden>
                        </div>
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="firstName" id="firstName" class="form-control form-control-lg"/>
                                        <label class="form-label" for="firstName">First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="lastName" id="lastName" class="form-control form-control-lg"/>
                                        <label class="form-label" for="lastName">Last Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="email" name="email" id="email" class="form-control form-control-lg"/>
                                        <label class="form-label" for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="tel" name="phoneNumber" id="phoneNumber" class="form-control form-control-lg"/>
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <input type="text" name="username" id="username" class="form-control form-control-lg"/>
                                        <label class="form-label" for="username">Username</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="password" name="password" id="password" class="form-control form-control-lg"/>
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 pt-2">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/userAuth/register',
                dataType: "html",
                data: $('form').serialize(),
                success: function(response) {
                    if (response === "ok") {
                        alert("Register Successful!");
                        window.location = "/login"
                    } else {
                        document.getElementById("greski").hidden = false;
                        $('#greski').html(response);
                    }
                },
                error: function(result) {
                    $('body').html("err");
                },
            });

        });

    });
</script>