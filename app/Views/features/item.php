<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                                       src="/uploads/<?php echo $item['imgLocation'] ?>"/></div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder"><?php echo $item['itemName'] ?></h1>
                <div class="fs-5 mb-5">
                    <span>Price: $<?php echo $item['price'] ?></span>
                </div>
                <div class="post">
                    <div class="post-action">
                        <!-- Rating Bar -->
                        <input id="item_<?php echo $item['id'] ?>" value='<?php echo $userRating ?>'
                               class="kv-ltr-theme-svg-star ratingbar" data-min="0" data-max="5"
                               data-step="1">
                        <!-- Average Rating -->
                        <div>Average Rating: <span
                                    id='averageRating'><?php echo $averageRating ?></span>
                        </div>
                    </div>
                </div>
                <p class="lead"><?php echo $item['description'] ?></p>
                <div class="d-flex">
                    <button class="btn btn-outline-dark flex-shrink-0" type="button">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </button>
                    <button id="<?php echo $item['id'] ?>" class="like btn btn-outline-dark" type="button"><span
                                class="fa fa-heart"></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments section -->

    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-8">
                <div class="d-flex flex-column comment-section">
                    <div class="bg-white p-2">
                        <div class="d-flex flex-row user-info">
                            <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">Marry Andrews</span><span class="date text-black-50">Shared publicly - Jan 2020</span></div>
                        </div>
                        <div class="mt-2">
                            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>

                    <div class="bg-light p-2">
                        <div class="d-flex flex-row align-items-start">
                            <textarea class="form-control ml-1 shadow-none textarea"></textarea>
                        </div>
                        <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none" type="button">Post comment</button><button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..."/>
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Fancy Product</h5>
                            <!-- Product price-->
                            $40.00 - $80.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('.like').click(function () {
            if (confirm("Add item to favourites?") === true) {
                const id = $(this).attr('id');

                $.ajax({
                    type: 'post',
                    url: '/features/isInFavourites',
                    data: {itemID: id},
                    success: function (response) {
                        if (response === "true") {
                            alert("Item already in Favourites!");
                            location.reload()
                        } else {
                            $.ajax({
                                url: '/features/addFavourite',
                                type: 'POST',
                                data: {
                                    itemID: id
                                },
                                success: function (data) {
                                    alert("Item added to favourites!");
                                }
                            });
                        }
                    },
                    error: function (result) {
                        $('body').html("err");
                    },
                });
            }
        });
    });

    $(document).ready(function () {

        // Initialize
        $('.ratingbar').rating({
            showCaption: false,
            showClear: false,
            size: 'sm'
        });

        // Rating change
        $('.ratingbar').on('rating:change', function (event, value, caption) {
            const id = this.id;
            const splitID = id.split('_');
            const itemID = splitID[1];

            $.ajax({
                url: '/features/rateItem',
                type: 'post',
                data: {
                    itemID: itemID,
                    rating: value,
                },
                success: function (response) {
                    $('#averageRating').text(response);
                }
            });
        });
    });
</script>