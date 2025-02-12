<?php
/* 
Plugin Name: WP Hallo Welt
Version: 1.4.
Plugin URI: http://wordpress.org/plugins/wp-hallo-welt
Description: Hallo Welt als Wordpress Plugin. Shortcode für Artikel und Seite [hw] - Sidebarwidget - Dashboard Menü und Seite
Author: Franz Wieser
Author URI: http://www.wieser.at
Licenc:  GPLv2
*/ 
function hallo_welt_shortcode($atts)

{
$hwtext=get_option('fw_hallowelt');
  return "<h2>Hallo in der Wordpress Welt</h2>".$hwtext."<br/>";

}
add_shortcode('hw', 'hallo_welt_shortcode');

function hallo_welt_sidebarwidget()
{
global $current_user;
   echo '<h3 class="widget-title">Hallo Welt</h3>';
   echo '<ul><li>hallo '.$current_user->display_name;
   echo ' in der Wordpress Welt:<br/>';

 echo get_option('fw_hallowelt');
echo '</li></ul>';

}

function hallo_welt_widget_init()
{
   wp_register_sidebar_widget('1',__('Hallo Welt'), 'hallo_welt_sidebarwidget');
}
add_action("plugins_loaded", "hallo_welt_widget_init");


function hallo_welt_seite()
{
global $current_user;
   echo '<div class="wrap">';
   echo '<H3>Hallo Welt</H3>';
   echo 'Hallo '.$current_user->display_name.' in der Wordpress Welt</p>';
   
   echo '- Shortcode - [ hw ] (ohne Leerzeichen) in deinem Artikel oder in deiner Seite eintragen<br/>';
   echo '- Sidebarwidget - im Dashboard - Design - Widget verwenden<br/>';
   echo '- Dashboard Menü - Hallo Welt mit Dashboard Seite (diese Seite)<p/>';
   echo 'weiter zu meinen Wordpress Plugins <a href="http://www.wieser.at/wordpress/plugins">Wieser Plugins</a>';
   echo '</div>';


if ( $_REQUEST['page'] == 'hallowelt' && isset( $_POST['submit'] ) ) {
$hallowelt=stripslashes($_POST['hallowelt']);

update_option( 'fw_hallowelt', $hallowelt);

   echo "Eintrag gespeichert<br/>";

   echo "AUSGABE Beispiel<br/>";
   $content="CONTENT";
$content=$hallowelt;


	       
   echo "<br/>".$content;
   
   
   
									  }
									  
 //  $post_types=get_post_types();									  
//	      echo $post_types;
?>

<form method="post" action="" id="fwhallowelt" class="validate">
   <h2>Hallo Welt:</h2>
<textarea name="hallowelt" cols="50" rows="10"><?php echo stripslashes(get_option('fw_hallowelt')); ?></textarea>
   <br/>
   Trage einen Text ein und dieser erscheint in den diversen Hallo Welt Ausgaben wie Shortcode, Sidebar Widget usw<br/>
   
   
  </p>
  <p class="submit"><input type="submit" name="submit" id="submit" class="button" value="Speichern"></p>
   </form>
   weitere Information zu diesem und weiteren Plugins auf <a href="http://www.wieser.at/wordpress/plugins">www.wieser.at/wordpress/plugins</a><br/>
   
   </div>
   

<?php	
}

function hallo_welt_plugin_menu()
{
add_menu_page('hallo welt', 'Hallo Welt', 'read', 'hallowelt', 'hallo_welt_seite');
}

add_action('admin_menu', 'hallo_welt_plugin_menu');
?>
