<?php // add the admin settings and such
function cmmntz_admin_init(){
  register_setting( 'cmmntz_options', 'cmmntz_options', 'cmmntz_options_validate' );
  add_settings_section('cmmntz_main', '', 'cmmntz_section_text', 'cmmntz');
  add_settings_field('cmmntz_id_string', 'CMMNTZ ID', 'cmmntz_id_field', 'cmmntz', 'cmmntz_main');
}

function cmmntz_section_text() {

}

function cmmntz_id_field() {
  $options = get_option('cmmntz_options');
  echo "<input id='cmmntz_id_string' name='cmmntz_options[id_string]' size='40' type='text' value='{$options['id_string']}' />";
}


function cmmntz_options_validate($input) {
  $myErrors = new WP_Error();
  $options = get_option('cmmntz_options');
  $options['id_string'] = trim($input['id_string']);
  if($options['id_string'] == '' ) {
    add_settings_error( 'cmmntz_id_string', "settings_updated", "Please provide your CMMNTZ ID.", "error" );
  } else if(!preg_match('/^[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}$/i', $options['id_string'])) {
    $options['id_string'] = '';
    add_settings_error( 'cmmntz_id_string', "settings_updated", "The format of your CMMNTZ ID is not correct.", "error" );
  }
  return $options;
}
