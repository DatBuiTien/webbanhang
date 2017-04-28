<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 3:36 PM
 */
?>

<div class="footer">
    <div class="wrap">
        <div class="section group">
            <div class="col_1_of_4 span_1_of_4">
                <h4>Information</h4>
                <ul>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Customer Service</a></li>
                    <li><a href="#">Advanced Search</a></li>
                    <li><a href="delivery.html">Orders and Returns</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Why buy from us</h4>
                <ul>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Customer Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="contact.html">Site Map</a></li>
                    <li><a href="#">Search Terms</a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>My account</h4>
                <ul>
                    <li><a href="contact.html">Sign In</a></li>
                    <li><a href="index.html">View Cart</a></li>
                    <li><a href="#">My Wishlist</a></li>
                    <li><a href="#">Track My Order</a></li>
                    <li><a href="contact.html">Help</a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Contact</h4>
                <ul>
                    <li><span>+91-123-456789</span></li>
                    <li><span>+00-123-000000</span></li>
                </ul>
                <div class="social-icons">
                    <h4>Follow Us</h4>
                    <ul>
                        <li><a href="#" target="_blank"><img src="<?php echo URL_FRONT_END?>/views/images/facebook.png" alt="" /></a></li>
                        <li><a href="#" target="_blank"><img src="<?php echo URL_FRONT_END?>/views/images/twitter.png" alt="" /></a></li>
                        <li><a href="#" target="_blank"><img src="<?php echo URL_FRONT_END?>/views/images/skype.png" alt="" /> </a></li>
                        <li><a href="#" target="_blank"> <img src="<?php echo URL_FRONT_END?>/views/images/dribbble.png" alt="" /></a></li>
                        <li><a href="#" target="_blank"> <img src="<?php echo URL_FRONT_END?>/views/images/linkedin.png" alt="" /></a></li>
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copy_right">
        <p>Company Name © All rights Reseverd | Design by  <a href="http://w3layouts.com">W3Layouts</a> </p>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $().UItoTop({ easingType: 'easeOutQuart' });

    });
    $('input[name="daterange"]').daterangepicker(
        {
            locale: {
                format: 'YYYY-MM-DD'
            },
            startDate: '2013-01-01',
            endDate: '2013-12-31'
        },
        function(start, end, label) {
            alert("A new date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
</script>
<a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>

