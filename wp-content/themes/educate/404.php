<?php
/**
 * 404 pages (not found)
*/
get_header(); ?>

<section>
<!--breadcrumb start-->
<div class="site-breadcumb-bg">
  <div class="educate-container container">
    <div class="row">
      <div class="site-breadcumb col-sm-8 col-md-9">
        <h1><?php _e('404','educate');?></h1>
        <ol class="breadcrumb breadcrumb-menubar">
          <?php if (function_exists('educate_custom_breadcrumbs')) educate_custom_breadcrumbs(); ?>
        </ol>
      </div>
      <div class="col-md-3 col-sm-4 breadcrumb-search">
      <?php get_search_form();?>
      </div>
    </div>
  </div>
</div>
<!--breadcrumb end-->
  <div class="educate-container container">
    <div class="posts-wrap posts-wrap-404">
      <div id="primary" class="content-area-404">
            <h1 class="page-title-404">
              <?php _e( 'Oops! That page can&rsquo;t be found.', 'educate' ); ?>
            </h1>
          <!-- .page-header -->
          <div class="page-content">
            <p>
              <?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'educate' ); ?>
            </p>
            <?php get_search_form(); ?>
          </div>
          <!-- .page-content -->
        <!-- .error-404 -->
      </div>
      <!-- .content-area -->
    </div>
  </div>
</section>
<?php get_footer(); ?>
