<?php
/*
Plugin Name: Widget della Salute by Equivalente.it
Plugin URI: http://www.equivalente.it
Description: The search cloud widget displays the most frequently searched terms on Equivalente.it, the Italian portal of generic drugs with news, games and a lot of useful information. 
Author: Equivalente.it
Version: 1.0
Author URI: http://www.equivalente.it
*/
 
function equiCloud($width,$type)
{
	

	$width = (substr($width,-1)=="%") ? $width : $width.'px';
	if($type==1)
		$js="automed";
	else if ($type==2)
		$js="patologie";
	else
		$js="principi";
	
  	echo '<script src="http://www.equivalente.it/widgets/w-'.$js.'.js" type="text/javascript"></script>
			<div id="equi-'.$js.'-widget-container" style="width:'.$width.';"></div>';
}
 
function widget_equiCloud($args) {
  
  extract ( $args );
  
  $options = get_option ( "widget_equiCloud" );
  if (! is_array ( $options )) {
  	$options = array ('title' => 'Widget della Salute','width'=>'300','type'=>'1' );
  }
  
$width = (substr($options ['width'],-1)=="%") ? $options ['width'] : $options ['width'].'px'; 

  //echo $before_widget;
  //echo $before_title;
  //echo $options ['title'];
  //echo $after_title;
  
  // Our Widget Content
echo '<div style="width:100%; text-align: center;margin: 4px 10px 24px 0px;"><div style="margin: 0 auto; text-align: left;width:'.$width.'">';
  equiCloud ($width,$options ['type']);
echo '</div></div>';
  //echo $after_widget;
}

function equiCloud_control() {
	$options = get_option ( "widget_equiCloud" );
	if (! is_array ( $options )) {
		$options = array ('title' => 'Widget della Salute','width'=>'300','type'=>'1' );
	}

	if ($_POST ['equiCloud-Submit']) {
		$options ['title'] = htmlspecialchars ( $_POST ['equiCloud-WidgetTitle'] );
		$options ['width'] = htmlspecialchars ( $_POST ['equiCloud-WidgetWidth'] );
		$options ['type'] = htmlspecialchars ( $_POST ['equiCloud-WidgetType'] );
		update_option ( "widget_equiCloud", $options );
	}

	?>
	<p>
	<!-- label for="equiCloud-WidgetTitle">Titolo:</label> 	
	<input class="widefat" type="text" id="equiCloud-WidgetTitle" name="equiCloud-WidgetTitle" value="<?php echo $options['title'];?>" />
	<br / -->
	<label for="equiCloud-WidgetWidth">Larghezza: </label> 	
	<select class="widefat" id="equiCloud-WidgetWidth" name="equiCloud-WidgetWidth">
		<option value="180" <?php if($options['width']==180) echo 'selected';?> >180px</option>
		<option value="240" <?php if($options['width']==240) echo 'selected';?>>240px</option>
		<option value="300" <?php if($options['width']==300) echo 'selected';?>>300px</option>	
                <option value="80%" <?php if($options['width']=='80%') echo 'selected';?>>80%</option>		 
                <option value="90%" <?php if($options['width']=='90%') echo 'selected';?>>90%</option>		 
                <option value="100%" <?php if($options['width']=='100%') echo 'selected';?>>100%</option>		 
	</select>
	
	<label for="equiCloud-WidgetType">Contenuto:</label> 	
	<select class="widefat" id="equiCloud-WidgetType" name="equiCloud-WidgetType">
		<option value="1" <?php if($options['type']==1) echo 'selected';?>>Automedicazione</option>
		<option value="2" <?php if($options['type']==2) echo 'selected';?>>Patologie</option>
		<option value="3" <?php if($options['type']==3) echo 'selected';?>>Principi Attivi</option>		 
	</select>
	<input type="hidden" id="equiCloud-Submit" name="equiCloud-Submit" value="1" />
	
	</p>
<?php
}

function equiCloud_init()
{
	register_widget_control ( 'Widget della Salute', 'equiCloud_control', 100, 100 );
  	register_sidebar_widget(__('Widget della Salute'), 'widget_equiCloud');
}
add_action("plugins_loaded", "equiCloud_init");
?>