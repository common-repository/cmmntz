<?php // display the admin options page
function cmmntz_options_page() {
?>
<div class="wrap">
  <h1>CMMNTZ Options</h1>
  <form action="options.php" method="post">
    <?php settings_fields('cmmntz_options'); ?>
    <?php do_settings_sections('cmmntz'); ?>

    <p>Welcome to the future of online CMMNTZ!! We tried fitting everything on this page but it’s just too awesome! So we created an amazing dashboard that you can configure <a href="https://www.cmmntz.com/login" target="_blank">here</a>.</p>

    <p>Don’t forget to create your totally free <a href="https://www.cmmntz.com/signup" target="_blank">CMMNTZ Account</a> to get started and join the revolution.</p>

    <p>Still have questions? Go ahead and submit a ticket on our <a href="https://wordpress.org/support/plugin/cmmntz/" target="_blank">support forum</a>. We keep a close eye on all inquires and will respond to you in no time flat!</p>

    <input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
  </form>
</div>

<?php
}?>
