<?php
/**
 * The template for displaying search form.
 *
 * @package Pick
 */
$softhopper_pick = get_option('softhopper_pick');
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form" method="get">
    <div class="input-group">
        <input type="search" name="s" placeholder="<?php esc_html_e( 'Search here &hellip;', 'pick' ); ?>" class="form-controller">
        <?php if ( $softhopper_pick['search_only_form_post'] == 1 ) : ?>
            <input type="hidden" value="post" name="post_type" id="post_type">
        <?php endif; ?>
        <span class="input-group-btn">
            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
        </span>
    </div>
</form>
