<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong">
                    <div class="card-body p-5">
                        <h3 class="mb-5 text-center">Sign in</h3>
                        <div class="alert alert-danger" id="greski" hidden>
                        </div>
                        <form>
                            <div class="form-outline mb-4">
                                <input type="text" name="username" id="username" class="form-control form-control-lg"/>
                                <label class="form-label" for="username">Username</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" name="password" id="password"
                                       class="form-control form-control-lg"/>
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                        </form>
                    </div>
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
                url: '/userAuth/login',
                dataType: "html",
                data: $('form').serialize(),
                success: function (response) {
                    if (response === "ok") {
                        alert("Login Successful!");
                        window.location = "/afterLogin"
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