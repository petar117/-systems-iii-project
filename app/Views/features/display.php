<!-- Section-->
<section class="py-5" id="main">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (!empty($data['items'])): ?>
                <?php foreach ($data['items'] as $item) { ?>
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
