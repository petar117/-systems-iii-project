<div class="container">
    <div class="card">
        <div class="container-fluid">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div class="preview-pic tab-content">
                        <div class="tab-pane active"><img src="/uploads/<?php echo $item['imgLocation'] ?>" width="100%"></div>
                    </div>
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title"><?php echo $item['itemName']?></h3>
                    <div class="rating">

                    </div>
                    <p class="product-description"><?php echo $item['description'] ?></p>
                    <h4 class="price">current price: <span><?php echo $item['price']?> </span></h4>

                    <div class="action">
                        <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                        <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>