<!-- Product section-->
<div class="py-5">
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
</div>
<!-- Comments section -->
<hr>
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment) { ?>
                    <div class="d-flex flex-column comment-section">
                        <div class="bg-white p-2">
                            <div class="d-flex flex-row user-info">
                                <div class="d-flex flex-column justify-content-start ml-2"><span
                                            class="d-block font-weight-bold name"><?php echo $comment['firstName'] . " " . $comment['lastName'] ?></span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="comment-text"><?php echo $comment['text'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div class="alert alert-primary" role="alert">
                    Be the first to comment!
                </div>
            <?php endif; ?>

            <div class="bg-light p-2">
                <div class="d-flex flex-row align-items-start">
                    <textarea id="textarea" class="form-control ml-1 shadow-none textarea"></textarea>
                </div>
                <div class="mt-2 text-right">
                    <button class="btn btn-primary btn-sm shadow-none" id="postComment" type="button">Post comment
                    </button>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Similar products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (!empty($similarItems)): ?>
                <?php foreach ($similarItems as $similarItem) { ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top" src="/uploads/<?php echo $similarItem['imgLocation'] ?>" alt="..."/>
                            <div class="card-body p-4">
                                <h5 class="card-title"><?php echo $similarItem['itemName'] ?></h5>
                                <p class="card-text"><small class="text-muted">Price:
                                        $<?php echo $similarItem['price'] ?></small></p>
                                <a href="/item/<?php echo $similarItem['id'] ?>" class="btn btn-primary">View item</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div class="alert alert-primary" role="alert">
                    No similar items in the shop currently!
                </div>
            <?php endif; ?>
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

    $(document).ready(function () {
        $('#postComment').click(function () {
            const text = $('#textarea').val();
            const id = <?php echo $item['id'] ?>;
            console.log(id)
            if (text === "") {
                alert("Please enter a comment!");
            } else {
                $.ajax({
                    url: '/features/postComment',
                    type: 'post',
                    data: {
                        itemID: id,
                        text: text,
                    },
                    success: function (response) {
                        if (response === "ok") {
                            location.reload();
                        }
                    }
                });
            }
        });
    });
</script>