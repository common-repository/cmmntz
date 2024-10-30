<?php
if (get_option('cmmntz_options')['id_string'] != '') {
?>
  <div id="respond" />
  <script src="https://api.cmmntz.com/javascripts/cmmntz-embed.js"></script>
  <script type="text/javascript">
  Cmmntz.init({
  galleryId: '<?php echo get_option('cmmntz_options')['id_string']; ?>',
  topics: '<?php foreach((get_the_category()) as $category) { echo $category->cat_name . ','; } ?>',
  publishDate: '<?php the_date('Y-m-d h:i:s'); ?>',
  artistName: '<?php the_author(); ?>',
  type: '<?php echo $post->post_type ?>',
  urlOverride: '<?php echo get_permalink($post); ?>'
  });
  </script>
  <noscript>
    Please enable JavaScript to see comments powered by CMMNTZ.
  </noscript>
<?php
}?>
