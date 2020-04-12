<?php
//require_once("includes/WordPressHelper/include.php");

use \ion\WordPress\WordPressHelper as WP;

?><ul id="footernav">
    <li><a href="">Waterfall Management Company</a></li>
    <li><a href="">Waterfall Estate</a></li>
    <li><a href="">Terms & Conditions</a></li>
    <li><a href="">Disclaimer</a></li>
    <li><a href="">Sitemap</a></li>
    <li><a href="">Website by REDi</a></li>
</ul><!--/footernav -->	

<footer>

    <div class="wrapper">

        <div class="column">
            <h6>Head Office</h6>
            <p>Ad Outpost Building<br>
                Woodmead North Office Park<br>
                54 Maxwell Drive<br>
                Jukskei View<br>
                Sandton, 2191</p>

            <p><strong>+27 82 745 6324</strong><br>
                <a href="">info@waterfall.co.za</a></p>		
        </div><!--/column -->


        <div class="column">
            <div class="social">
                <a href="" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="" target="_blank"><i class="fa fa-linkedin"></i></a>
                <a href="" target="_blank"><i class="fa fa-instagram"></i></a> 	
            </div>
            <p class="copyright">&copy; Copyright <script type="text/javascript">
                var d = new Date();
                document.write(d.getFullYear());
                </script>. Octotel, LLC is a registered trademark of Lorem Ipsum, LLC.
            </p>
            <p class="backtotop"><a href="#" onclick="scrollToTop();return false"><i class="fa fa-arrow-circle-up"></i></a></p>
        </div><!--/column -->

    </div><!-- /wrapper -->
</footer>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="<?php echo WP::GetThemeUri(); ?>js/scripts.js"></script>

    <?php wp_footer(); ?>
</body>
</html>