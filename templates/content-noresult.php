<div class="noresults">
    <h3>No Results Found</h3>
    <p>Please try again with some different keywords.</p>
    <form class="form-group searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="text" value="<?php echo esc_attr( get_search_query() );?>" name="s" class="form-control" placeholder="Hit enter to search" />
        <input type="submit" class="searchsubmit">
        <i class="fa fa-search"></i>
    </form>
</div>