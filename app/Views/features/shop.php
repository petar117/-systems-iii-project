<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <form class="card card-sm">
                        <div class="card-body row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fa fa-search h4"></i>
                            </div>
                            <!--end of col-->
                            <div class="col">
                                <input class="form-control form-control-lg form-control-borderless" id="textarea" type="search" placeholder="Search topics or keywords">
                            </div>
                            <!--end of col-->
                            <div class="col-auto">
                                <button class="btn btn-lg btn-success" id="searchButton" type="submit">Search</button>
                            </div>
                            <!--end of col-->
                        </div>
                    </form>
                </div>
                <!--end of col-->
            </div>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item) { ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="/uploads/<?php echo $item['imgLocation'] ?>"/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $item['itemName'] ?></h5>
                                    <!-- Product price-->
                                    $<?php echo $item['price'] ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="/item/<?php echo $item['id'] ?>">View
                                        item</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div class="alert alert-primary" role="alert">
                    No items in the shop currently!
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>

    $(document).ready(function() {

        $('#searchButton').click(function(event, value, caption) {
            event.preventDefault();
            const text = $("#textarea").val();
            if (text == '') {
                alert("Please review your search parameters");
            } else {
                $.ajax({
                    url: '/features/shop/search',
                    type: 'post',
                    dataType: "html",
                    data: {
                        text: text,
                    },
                    success: function(response) {
                        $('body').html(response);
                    },
                    error: function(result) {
                        $('body').html("err");
                    },
                    beforeSend: function(d) {
                        $('body').html("Searching...");
                    }
                });
            }
        })
    });
</script>