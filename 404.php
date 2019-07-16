<?php
    get_header();
?>

<div class="notfound">
    <div class="container">
        <h3>404</h3>
        <p>OOOOOPS!! The page you are looking for doesnt exist!</p>
        <a href="<?php echo esc_url( home_url() ); ?>" class="home-btn">Back To Home</a>
    </div>
</div>

<?php
    get_footer();
?>