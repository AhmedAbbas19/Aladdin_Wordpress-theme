<?php if ( is_active_sidebar( 'sidebar-l' ) || is_active_sidebar( 'sidebar-m' ) || is_active_sidebar( 'sidebar-r' ) ) { ?>
<div class="footer">
    <div class="container-fluid">
        <div class="col-sm-4">
        <?php 
            dynamic_sidebar('sidebar-l');
        ?>
        </div>
        <div class="col-sm-4">
        <?php 
            dynamic_sidebar( 'sidebar-m' );
        ?>
        </div>
        <div class="col-sm-4">
        <?php
            dynamic_sidebar( 'sidebar-r' );
        ?>
        </div>
    </div>
</div>
<?php
    }
?>


<div class="footer-notice">
    <?php
        if ( is_active_sidebar( 'sidebar-notice' )){
            dynamic_sidebar('sidebar-notice');
        }
    ?>
</div>

<?php wp_footer(); ?>
</body>
</html>
