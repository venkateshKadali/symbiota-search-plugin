<?php
function symbiota_add_custom_metabox(){

	add_meta_box(
		'symbiota_meta',
		'Symbiota Search',
		'symbiota_meta_callback',
		'symbiota_search',
		'normal',
		'high'
	);

}

add_action('add_meta_boxes', 'symbiota_add_custom_metabox');

function symbiota_meta_callback( $post ){
	wp_nonce_field( basename(__FILE__ ), 'symbiota_jobs_nonce');
	$symbiota_stored_meta = get_post_meta( $post->ID );
	?>

	<form action="#" method="POST">
	<div>
		<div id="taxonSearch0">
			<div>
				<h1><?php echo "Taxonomic Criteria:" ?></h1>
				<span style="margin-left:5px;"><input type='checkbox' name='thes' value='1' CHECKED />
					<?php echo "Include Synonyms from Taxonomic Thesaurus" ?></span>
				</div>
				<div>
					<select id="taxontype" name="type">
						<option value='1'><?php echo "Family or Scientific name" ?></option>
						<option value='2'><?php echo "Family only" ?></option>
						<option value='3'><?php echo "Scientiic name only" ?></option>
						<option value='4'><?php echo "Higher Taxonomy" ?></option>
						<option value='5'><?php echo "Common Name" ?></option>
					</select>:
					<input id="taxa" type="text" size="60" name="taxa" value="" title="<?php echo "" ?>" />
					<input type='checkbox' name='cb_taxontype' value='taxontype' /> <?php echo ""; ?>
				</div>

			</div>
			<div style="margin:10 0 10 0;"><hr></div>
			<div>
				<h1><?php echo "Locality Criteria:" ?></h1>
			</div>


			<div>
				<?php echo "Country"?> <input type="text" id="country" size="43" name="country" value="" title="<?php echo $LANG['TITLE_TEXT_1']; ?>" />
				<input type='checkbox' name='cb_country' value='country' /> <?php echo ""; ?>
			</div>
			<div>
				<?php echo "State" ?> <input type="text" id="state" size="37" name="state" value="" title="<?php echo $LANG['TITLE_TEXT_1']; ?>" />
				<input type='checkbox' name='cb_state' value='state' /> <?php echo ""; ?>
			</div>
			<div>
				<?php echo "County" ?> <input type="text" id="county" size="37"  name="county" value="" title="<?php echo $LANG['TITLE_TEXT_1']; ?>" />
				<input type='checkbox' name='cb_county' value='county' /> <?php echo ""; ?>
			</div>
			<div>
				<?php echo "Locality" ?> <input type="text" id="locality" size="43" name="local" value="" />
				<input type='checkbox' name='cb_local' value='locality' /> <?php echo ""; ?>
			</div>
			<div>
				<?php echo "Elevation(m)" ?> <input type="text" id="elevlow" size="10" name="elevlow" value="" /> <?php echo "to" ?>
				<input type="text" id="elevhigh" size="10" name="elevhigh" value="" />
				<input type='checkbox' name='cb_elev' value='elev' /> <?php echo ""; ?>
			</div>

			<div style="margin:10 0 10 0;"><hr></div>
			<div>
				<h1><?php echo "Latitude and Longitude:" ?></h1>
			</div>

			<!-- <div style="width:300px;float:left;border:2px solid brown;padding:10px;margin-bottom:10px;"> -->
				<div style="font-weight:bold;">
					<?php echo "Bounding box coordinates in decimal degrees" ?>
					<input type='checkbox' name='cb_box' value='box' /> <?php echo ""; ?>
				</div>
				<div>
					<?php echo "Northern Latitude: "; ?> <input type="text" id="upperlat" name="upperlat" size="7" value="" onchange="checkUpperLat();" style="margin-left:9px;">
					<select id="upperlat_NS" name="upperlat_NS" onchange="checkUpperLat();">
						<option id="nlN" value="N"><?php echo "N"; ?></option>
						<option id="nlS" value="S"><?php echo "S"; ?></option>
					</select>
				</div>
				<div>
					<?php echo "Southern Latitude: "; ?> <input type="text" id="bottomlat" name="bottomlat" size="7" value="" onchange="javascript:checkBottomLat();" style="margin-left:7px;">
					<select id="bottomlat_NS" name="bottomlat_NS" onchange="checkBottomLat();">
						<option id="blN" value="N"><?php echo "N"; ?></option>
						<option id="blS" value="S"><?php echo "S"; ?></option>
					</select>
				</div>
				<div>
					<?php echo "Western Longitude: "; ?> <input type="text" id="leftlong" name="leftlong" size="7" value="" onchange="javascript:checkLeftLong();">
					<select id="leftlong_EW" name="leftlong_EW" onchange="checkLeftLong();">
						<option id="llW" value="W"><?php echo "W"; ?></option>
						<option id="llE" value="E"><?php echo "E"; ?></option>
					</select>
				</div>
				<div>
					<?php echo "Eastern Longitude: "; ?> <input type="text" id="rightlong" name="rightlong" size="7" value="" onchange="javascript:checkRightLong();" style="margin-left:3px;">
					<select id="rightlong_EW" name="rightlong_EW" onchange="checkRightLong();">
						<option id="rlW" value="W"><?php echo "W"; ?></option>
						<option id="rlE" value="E"><?php echo "E"; ?></option>
					</select>
				</div>
				<div style="clear:both;float:right;margin-top:8px;cursor:pointer;" onclick="openBoundingBoxMap();">
					<img src="../images/world.png" width="15px" title="<?php echo $LANG['LL_P-RADIUS_TITLE_1']; ?>" />
				</div>
				<!-- </div> -->

				<!-- <div style="width:260px; float:left;border:2px solid brown;padding:10px;margin-left:10px;"> -->
					<div style="font-weight:bold;">
						<?php echo "Point-Radius Search" ?>
						<input type='checkbox' name='cb_radius' value='radius' /> <?php echo ""; ?>
					</div>
					<div>
						<?php echo "Latitude: "; ?> <input type="text" id="pointlat" name="pointlat" size="7" value="" onchange="javascript:checkPointLat();" style="margin-left:11px;">
						<select id="pointlat_NS" name="pointlat_NS" onchange="checkPointLat();">
							<option id="N" value="N"><?php echo "N"; ?></option>
							<option id="S" value="S"><?php echo "S"; ?></option>
						</select>
					</div>
					<div>
						<?php echo "Longitude: "; ?> <input type="text" id="pointlong" name="pointlong" size="7" value="" onchange="javascript:checkPointLong();">
						<select id="pointlong_EW" name="pointlong_EW" onchange="checkPointLong();">
							<option id="W" value="W"><?php echo "W"; ?></option>
							<option id="E" value="E"><?php echo "E"; ?></option>
						</select>
					</div>
					<div>
						<?php echo "Radius: "; ?> <input type="text" id="radiustemp" name="radiustemp" size="5" value="" style="margin-left:15px;" onchange="updateRadius();">
						<select id="radiusunits" name="radiusunits" onchange="updateRadius();">
							<option value="km"><?php echo "Kilometers"; ?></option>
							<option value="mi"><?php echo "Miles"; ?></option>
						</select>
						<input type="hidden" id="radius" name="radius" value="" />
					</div>
					<div style="clear:both;float:right;margin-top:8px;cursor:pointer;" onclick="openPointRadiusMap();">
						<img src="../images/world.png" width="15px" title="<?php echo $LANG['LL_P-RADIUS_TITLE_1']; ?>" />
					</div>
					<!-- </div> -->

					<div style=";clear:both;"><hr/></div>
					<div>
						<h1><?php echo "Collector Criteria" ?></h1>
					</div>
					<div>
						<?php echo "Collector's Last Name: "; ?>
						<input type="text" id="collector" size="32" name="collector" value="" title="<?php echo $LANG['TITLE_TEXT_1']; ?>" />
						<input type='checkbox' name='cb_collector' value='collector' /> <?php echo ""; ?>
					</div>
					<div>
						<?php echo "Collector's Number: "; ?>
						<input type="text" id="collnum" size="31" name="collnum" value="" title="<?php echo $LANG['TITLE_TEXT_2']; ?>" />
						<input type='checkbox' name='cb_collnum' value='collnum' /> <?php echo ""; ?>
					</div>
					<div>
						<?php echo "Collection Date: "; ?>
						<input type="text" id="eventdate1" size="32" name="eventdate1" style="width:100px;" value="" title="<?php echo $LANG['TITLE_TEXT_3']; ?>" /> -
						<input type="text" id="eventdate2" size="32" name="eventdate2" style="width:100px;" value="" title="<?php echo $LANG['TITLE_TEXT_4']; ?>" />
						<input type='checkbox' name='cb_eventdate' value='eventdate' /> <?php echo ""; ?>
					</div>

					<div style=";clear:both;"><hr/></div>

					<div>
						<h1><?php echo "Specimen Criteria" ?></h1>
					</div>
					<div>
						<?php echo "Catalog Number: "; ?>
						<input type="text" id="catnum" size="32" name="catnum" value="" title="<?php echo $LANG['TITLE_TEXT_1']; ?>" />
						<input name="includeothercatnum" type="checkbox" value="1" checked /> <?php echo " Include other catalog numbers and GUIDs "?>
						<input type='checkbox' name='cb_catnum' value='catnum' /> <?php echo ""; ?>
					</div>
					<div>
						<input type='checkbox' name='typestatus' value='1' /> <?php echo " Limit to Type Specimens Only "; ?>
						<input type='checkbox' name='cb_typestatus' value='typestatus' /> <?php echo ""; ?>
					</div>
					<div>
						<input type='checkbox' name='hasimages' value='1' /> <?php echo "Limit to Specimens with Images Only "; ?>
						<input type='checkbox' name='cb_hasimages' value='hasimages' /> <?php echo ""; ?>
					</div>
					<div>
						<input type='checkbox' name='hasgenetic' value='1' /> <?php echo "Limit to Specimens with Genetic Data Only "; ?>
						<input type='checkbox' name='cb_hasgenetic' value='hasgenetic' /> <?php echo ""; ?>
					</div>
					<input type="hidden" name="reset" value="1" />
				</div>

				<div style="margin:10 0 10 0;"><hr></div>
				<div>
					<h1><?php echo "Templates" ?></h1>
				</div>


				<div>
					<?php echo "Template1"?> 
					<input type='radio' name='rd_template' value='template1' checked/>
				</div>
				<div>
					<?php echo "Template2"?> 
					<input type='radio' name='rd_template' value='template2' /> 
				</div>
				<div>
					<?php echo "Template3"?> 
					<input type='radio' name='rd_template' value='template3' /> 
				</div>


			</form>
	<?php
}

function symbiota_meta_save($post){
	$is_autosave = wp_is_post_autosave($post);
	$is_revision = wp_is_post_revision($post);
	$is_valid_nonce = (isset($_POST['symbiota_jobs_nonce']) &&  wp_verify_nonce( 
		$_POST[ 'symbiota_jobs_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

if( isset($_POST['cb_taxontype'])){
		update_post_meta($post, 'cb_taxontype', sanitize_text_field($_POST['cb_taxontype']));

	}

	if ( isset( $_POST[ 'cb_country' ] ) ) {
		update_post_meta( $post, 'cb_country', sanitize_text_field( $_POST[ 'cb_country' ] ) );
    }

    if( isset($_POST['cb_state'])){
    	update_post_meta($post, 'cb_state', sanitize_text_field($_POST['cb_state']));

    }
    if( isset($_POST['cb_county'])){
    	update_post_meta($post, 'cb_county', sanitize_text_field($_POST['cb_county']));
    	
    }
    if( isset($_POST['cb_local'])){
    	update_post_meta($post, 'cb_local', sanitize_text_field($_POST['cb_local']));
    	
    }
    if( isset($_POST['cb_elev'])){
    	update_post_meta($post, 'cb_elev', sanitize_text_field($_POST['cb_elev']));
    	
    }

    if( isset($_POST['cb_box'])){
    	update_post_meta($post, 'cb_box', sanitize_text_field($_POST['cb_box']));

    }
    if( isset($_POST['cb_radius'])){
    	update_post_meta($post, 'cb_radius', sanitize_text_field($_POST['cb_radius']));

    }
    if( isset($_POST['cb_collector'])){
    	update_post_meta($post, 'cb_collector', sanitize_text_field($_POST['cb_collector']));

    }
    if( isset($_POST['cb_collnum'])){
    	update_post_meta($post, 'cb_collnum', sanitize_text_field($_POST['cb_collnum']));

    }
    if( isset($_POST['cb_eventdate'])){
    	update_post_meta($post, 'cb_eventdate', sanitize_text_field($_POST['cb_eventdate']));

    }
    if( isset($_POST['cb_catnum'])){
    	update_post_meta($post, 'cb_catnum', sanitize_text_field($_POST['cb_catnum']));

    }
    if( isset($_POST['cb_typestatus'])){
    	update_post_meta($post, 'cb_typestatus', sanitize_text_field($_POST['cb_typestatus']));

    }
    if( isset($_POST['cb_hasimages'])){
    	update_post_meta($post, 'cb_hasimages', sanitize_text_field($_POST['cb_hasimages']));

    }
    if( isset($_POST['cb_hasgenetic'])){
    	update_post_meta($post, 'cb_hasgenetic', sanitize_text_field($_POST['cb_hasgenetic']));

    }
    if( isset($_POST['rd_template'])){
    	delete_post_meta($post, 'template1', sanitize_text_field('template1'));
    	delete_post_meta($post, 'template2', sanitize_text_field('template2'));
    	delete_post_meta($post, 'template3', sanitize_text_field('template3'));
    	add_post_meta($post, $_POST['rd_template'], sanitize_text_field($_POST['rd_template']));

    }
	return $post;    
}
add_action('save_post', 'symbiota_meta_save');

?>