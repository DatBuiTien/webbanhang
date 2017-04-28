<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 26-Apr-17
 * Time: 9:13 AM
 */
require_once 'header.php';
require_once 'menu_slide.php';
?>
    <div class="main">
        <div class="content">

            <div class="content_top">
                <div class="heading">
                    <h3>Your shopping card</h3>
                </div>
                <div class="clear"></div>
            </div>

            <div class="section group">
                <?php
                if(isset($_SESSION['data']) > 0) {
                    foreach ($_SESSION['data'] as $key => $value) { ?>
                        <div class="grid_1_of_4 images_1_of_4" style="margin-left: 0px; width: 22%">
                            <a href="product_controller.php?action=index&product=<?php echo $value['id'] ?>"><img
                                    src="<?php echo URL_FRONT_END ?>/uploads/products/<?php echo $value['image'] ?>"
                                    alt=""/></a>
                            <h2><?php echo $value['p_name'] ?></h2>
                            <div class="price-details">
                                <div class="price-number">
                                    <p><span class="rupees"><?php echo number_format($value['price']) ?><span
                                                style="font-size: 17px"> VND x </span><?php echo $value['quantity'] ?></span>
                                    </p>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    <?php }
                }else{
                    echo '<h1>No have</h1>';
                }
                ?>
            </div>

            <div class="content_top">
                <div class="heading">
                    <h3>Order</h3>
                </div>
                <div class="clear"></div>
            </div>

            <div class="section group" >
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Name Product</h4>
                    <ul>
                        <?php foreach ($_SESSION['data'] as $item => $value){ ?>
                            <li><span><?php echo $value['p_name']?></span></li>
                        <?php }?>
                    </ul>
                </div>

                <div class="col_1_of_4 span_1_of_4">
                    <h4>Unit price</h4>
                    <ul>
                        <?php foreach ($_SESSION['data'] as $item => $value){ ?>
                            <li><span><?php echo number_format($value['price']).' VND/ONE'?></span></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Quantity</h4>
                    <ul>
                        <?php foreach ($_SESSION['data'] as $item => $value){ ?>
                            <li><span><?php echo $value['quantity']?></span></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Price</h4>
                    <ul>
                        <?php foreach ($_SESSION['data'] as $item => $value){ ?>
                            <li><span><?php echo number_format($value['total']).' VND' ?></span></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <div class="content_top">
                <div class="heading">
                    <h3>Total</h3>
                </div>
                <div class="clear"></div>
            </div>

            <div class="section group">
                <div class="col_1_of_4 span_1_of_4" style="padding-bottom: 0">
                    <h4 style="border-bottom: none"><?php echo number_format($_SESSION['total']).' vnd'?></h4>

                </div>
            </div>
            <button href="preview.html" onclick="showOrder()" class="button">Buy</button>

        </div>

    </div>
    <div class="contact-form" style="display: none" id="showorder">
        <h2>Contact Us</h2>
        <form method="post" action="contact-post.html">
            <div>
                <span><label>Name</label></span>
                <span><input name="userName" type="text" class="textbox"></span>
            </div>
            <div>
                <span><label>E-mail</label></span>
                <span><input name="userEmail" type="text" class="textbox"></span>
            </div>
            <div>
                <span><label>Phone</label></span>
                <span><input name="userPhone" type="text" class="textbox"></span>
            </div>
            <div>
                <span><label>Address</label></span>
                <span><input name="address" type="text" class="textbox"></span>
            </div>
            <div>
                <span><label>Date Reqired</label></span>
                <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" />
                <script type="text/javascript">
                    $(function() {
                        $('input[name="daterange"]').daterangepicker();
                    });
                </script>
            </div>
            <div>
                <span><input type="submit" value="Submit" class="myButton"></span>
            </div>
        </form>
    </div>
    </div>

<?php
require_once 'footer.php';
?>