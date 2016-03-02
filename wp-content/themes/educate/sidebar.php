<?php
/**
 * The Sidebar template file
 * */
if (is_page_template('page-templates/left-sidebar.php')) {
    $educate_sidebar_class = '';
} else {
    $educate_sidebar_class = ' col-md-offset-1';
}
?>

<div class="col-md-3 col-sm-4 <?php echo $educate_sidebar_class; ?>">
    <div class="sidebar-box">
        <?php
        if (is_active_sidebar('sidebar-1')) {
            dynamic_sidebar('sidebar-1');
        }
        ?>
    </div>
</div>
