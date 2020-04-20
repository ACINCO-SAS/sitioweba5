
            </div>
            <!--Start Footer-->
            <footer id="footer" class="bgimgAzul">
                <div class="container _col-sm-12 _pr4 _pl4 cblanco pt3 pb3">
                    <h2 class="txtac helv-md fn5m">Contáctanos</h2>
                    <div class="row _col-sm-12 pt2 pb2 pl0 pr0 d-flex">
                        <?php
                            if (is_active_sidebar( 'first-footer-widget-area' )){
                                ?>
                                <div class="footer1 col-sm-5">
                                    <?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
                                </div>
                            <?php }
                            else{
                                echo '<h1 class="txtac">'. get_bloginfo( 'name' ) .'</h1>';
                            }
                            if (is_active_sidebar( 'second-footer-widget-area' ) ){ ?>
                                <div class="footer1-2 col-sm-7 borleft2">
                                    <?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
                                </div>
                                <?php
                            }else{
                                echo '<h1 class="txtac">'. get_bloginfo( 'name' ) .'</h1>';
                            }
                        ?>
                    </div>
                </div>
                <?php if (is_active_sidebar( 'four-footer-widget-area' ) ){ ?>
                    <div class="footer2 bgblanco txtac cazul fn-2m">
                        <?php dynamic_sidebar( 'four-footer-widget-area' ); ?>
                    </div>
                <?php } ?>
                <div class="clr"></div>
            </footer>
            <!--End Footer-->
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>