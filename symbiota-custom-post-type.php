<?php

include_once('symbiota/config/symbini.php');

add_shortcode('symbiota', 'symbiota_shortcode_function');

function symbiota_shortcode_function($attr, $content){

	extract(shortcode_atts(array(
		'id' => ''
	), $attr));
	?>
	
	<form name="harvestparams" id="harvestparams" action="../wp-content/plugins/symbiota/search.php" method="post" onsubmit="return checkHarvestparamsForm(this);">
		<?php


		if(get_post_meta($id,'cb_taxontype') != NULL){
			?>
			<div id="taxonSearch0">
				<div>
					<h3><?php echo "Taxonomic Criteria:" ?></h3>
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
					</div>

				</div>
				<?php
			}



			if(get_post_meta($id, 'cb_country') != NULL || get_post_meta($id, 'cb_state') != NULL || get_post_meta($id, 'cb_county') != NULL || get_post_meta($id, 'cb_local') != NULL || get_post_meta($id, 'cb_elev') != NULL){
				?>
				<div>
					<h3><?php echo "Locality Criteria:" ?></h3>
				</div>
				<?php
			}
			if(get_post_meta($id, 'cb_country') != NULL){
				?>
				<div>
					<?php echo "Country" ?> <input type="text" id="country" size="43" name="country" value="" title="<?php echo $LANG['TITLE_TEXT_1']; ?>" />
				</div>
				<?php
			}
			if(get_post_meta($id, 'cb_state') != NULL){
				?>
				<div>
					<?php echo "State" ?> <input type="text" id="state" size="43" name="state" value="" title="<?php echo $LANG['TITLE_TEXT_1']; ?>" />
				</div>
				<?php
			}
			if(get_post_meta($id, 'cb_county') != NULL){
				?>
				<div>
					<?php echo "County" ?> <input type="text" id="county" size="43" name="county" value="" title="<?php echo $LANG['TITLE_TEXT_1']; ?>" />
				</div>
				<?php
			}
			if(get_post_meta($id, 'cb_local') != NULL){
				?>
				<div>
					<?php echo "Locality" ?> <input type="text" id="local" size="43" name="local" value="" title="<?php echo $LANG['TITLE_TEXT_1']; ?>" />
				</div>
				<?php
			}
			if(get_post_meta($id, 'cb_elev') != NULL){
				?>
				<div>
					<?php echo "Elevation(m)" ?> <input type="text" id="elevlow" size="10" name="elevlow" value="" /> <?php echo "to" ?>
					<input type="text" id="elevhigh" size="10" name="elevhigh" value="" />
				</div>
				<?php
			}



			if(get_post_meta($id, 'cb_box') != NULL || get_post_meta($id, 'cb_radius') != NULL){
				?>
				<div>
					<h3><?php echo "Latitude and Longitude:" ?></h3>
				</div>
				<?php
			}

			if(get_post_meta($id, 'cb_box') != NULL){
				?>

				<!-- <div style="width:300px;float:left;border:2px solid brown;padding:10px;margin-bottom:10px;"> -->
					<div style="font-weight:bold;">
						<?php echo "Bounding box coordinates in decimal degrees" ?>
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
					<?php
				}

				if(get_post_meta($id, 'cb_radius') != NULL){
					?>
					<div style="font-weight:bold;">
						<?php echo "Point-Radius Search" ?>
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
					<?php
				}

				if(get_post_meta($id, 'cb_collector') != NULL || get_post_meta($id, 'cb_collnum') != NULL || get_post_meta($id, 'cb_eventdate') != NULL){
					?>
					<div>
						<h3><?php echo "Collector Criteria" ?></h3>
					</div>
					<?php
				}

				if(get_post_meta($id, 'cb_collector') != NULL){
					?>
					<div>
						<?php echo "Collector's Last Name: "; ?>
						<input type="text" id="collector" size="32" name="collector" value="" title="<?php echo $LANG['TITLE_TEXT_1']; ?>" />
					</div>
					<?php
				}
				if(get_post_meta($id, 'cb_collnum') != NULL){
					?>
					<div>
						<?php echo "Collector's Number: "; ?>
						<input type="text" id="collnum" size="31" name="collnum" value="" title="<?php echo $LANG['TITLE_TEXT_2']; ?>" />
					</div>
					<?php
				}
				if(get_post_meta($id, 'cb_eventdate') != NULL){
					?>
					<div>
						<?php echo "Collection Date: "; ?>
						<input type="text" id="eventdate1" size="32" name="eventdate1" style="width:100px;" value="" title="<?php echo $LANG['TITLE_TEXT_3']; ?>" /> -
						<input type="text" id="eventdate2" size="32" name="eventdate2" style="width:100px;" value="" title="<?php echo $LANG['TITLE_TEXT_4']; ?>" />
					</div>
					<?php
				}

				if(get_post_meta($id, 'cb_catnum') != NULL || get_post_meta($id, 'cb_typestatus') != NULL || get_post_meta($id, 'cb_hasimages') != NULL || get_post_meta($id, 'cb_hasgenetic') != NULL){
					?>
					<div>
						<h3><?php echo "Specimen Criteria" ?></h3>
					</div>
					<?php
				}
				if(get_post_meta($id, 'cb_catnum') != NULL){
					?>
					<div>
						<?php echo "Catalog Number: "; ?>
						<input type="text" id="catnum" size="32" name="catnum" value="" title="<?php echo $LANG['TITLE_TEXT_1']; ?>" />
						<input name="includeothercatnum" type="checkbox" value="1" checked /> <?php echo " Include other catalog numbers and GUIDs "?>
					</div>
					<?php
				}
				if(get_post_meta($id, 'cb_typestatus') != NULL){
					?>
					<div>
						<input type='checkbox' name='typestatus' value='1' /> <?php echo " Limit to Type Specimens Only "; ?>
					</div>
					<?php
				}
				if(get_post_meta($id, 'cb_hasimages') != NULL){
					?>
					<div>
						<input type='checkbox' name='hasimages' value='1' /> <?php echo "Limit to Specimens with Images Only "; ?>
					</div>
					<?php
				}
				if(get_post_meta($id, 'cb_hasgenetic') != NULL){
					?>
					<div>
						<input type='checkbox' name='hasgenetic' value='1' /> <?php echo "Limit to Specimens with Genetic Data Only "; ?>
					</div>
					<?php
				}
				if(get_post_meta($id, 'template1') != NULL){
					?>
					<div>
						<input type = "hidden" name='template1' value="true">

					</div>
					<?php
				}
				if(get_post_meta($id, 'template2') != NULL){
					?>
					<div>
						<input type = "hidden" name='template2' value="true">
					</div>
					<?php
				}
				if(get_post_meta($id, 'template3') != NULL){
					?>
					<div>
						<input type = "hidden" name='template3' value="true">
					</div>
					<?php
				}



				?>

				<div style="margin-bottom:10px; margin-top: 10px"><input type="submit" class="nextbtn" value="Search" /></div>

			</form>
			<?php
		}
		?>

		<script type="text/javascript">
			var starrJson = '';

			$(document).ready(function() {
				<?php
				if($stArrCollJson){
					echo "sessionStorage.jsoncollstarr = '".$stArrCollJson."';\n";
				}

				if($stArrSearchJson){
					?>
					starrJson = '<?php echo $stArrSearchJson; ?>';
					sessionStorage.jsonstarr = starrJson;
					setHarvestParamsForm();
					<?php
				}
				else{
					?>
					if(sessionStorage.jsonstarr){
						starrJson = sessionStorage.jsonstarr;
						setHarvestParamsForm();
					}
					<?php
				}
				?>
			});
			function checkHarvestparamsForm(frm){
				<?php
				if(!$SOLR_MODE){
					?>
                //make sure they have filled out at least one field.
                if ((frm.taxa.value == '') && (frm.country.value == '') && (frm.state.value == '') && (frm.county.value == '') &&
                	(frm.locality.value == '') && (frm.upperlat.value == '') && (frm.pointlat.value == '') && (frm.catnum.value == '') &&
                	(frm.elevhigh.value == '') && (frm.eventdate2.value == '') && (frm.typestatus.checked == false) && (frm.hasimages.checked == false) && (frm.hasgenetic.checked == false) &&
                	(frm.collector.value == '') && (frm.collnum.value == '') && (frm.eventdate1.value == '') && (frm.elevlow.value == '')) {
                	alert("Please fill in at least one search parameter!");
                return false;
            }
            <?php
        }
        ?>

        if(frm.upperlat.value != '' || frm.bottomlat.value != '' || frm.leftlong.value != '' || frm.rightlong.value != ''){
                // if Lat/Long field is filled in, they all should have a value!
                if(frm.upperlat.value == '' || frm.bottomlat.value == '' || frm.leftlong.value == '' || frm.rightlong.value == ''){
                	alert("Error: Please make all Lat/Long bounding box values contain a value or all are empty");
                	return false;
                }

                // Check to make sure lat/longs are valid.
                if(Math.abs(frm.upperlat.value) > 90 || Math.abs(frm.bottomlat.value) > 90 || Math.abs(frm.pointlat.value) > 90){
                	alert("Latitude values can not be greater than 90 or less than -90.");
                	return false;
                }
                if(Math.abs(frm.leftlong.value) > 180 || Math.abs(frm.rightlong.value) > 180 || Math.abs(frm.pointlong.value) > 180){
                	alert("Longitude values can not be greater than 180 or less than -180.");
                	return false;
                }
                if(parseFloat(frm.upperlat.value) < parseFloat(frm.bottomlat.value)){
                	alert("Your northern latitude value is less then your southern latitude value. Please correct this.");
                	return false;
                }
                if(parseFloat(frm.leftlong.value) > parseFloat(frm.rightlong.value)){
                	alert("Your western longitude value is greater then your eastern longitude value. Please correct this. Note that western hemisphere longitudes in the decimal format are negitive.");
                	return false;
                }
            }

            //Same with point radius fields
            if(frm.pointlat.value != '' || frm.pointlong.value != '' || frm.radius.value != ''){
            	if(frm.pointlat.value == '' || frm.pointlong.value == '' || frm.radius.value == ''){
            		alert("Error: Please make all Lat/Long point-radius values contain a value or all are empty");
            		return false;
            	}
            }

            if(frm.elevlow.value || frm.elevhigh.value){
            	if(isNaN(frm.elevlow.value) || isNaN(frm.elevhigh.value)){
            		alert("Error: Please enter only numbers for elevation values");
            		return false;
            	}
            }

            return true;
        }
    </script>

    <?php
    function symbiota_post_type_search(){	
    	$singular = __('Symbiota Search');
    	$plural = __('Symbiota Search');
    	$slug1 = str_replace( ' ', '_', strtolower( $singular ) );

    	$labels = array(
    		'name'				=>$plural,
    		'singular_name'		=>$singular,
    		'add_new'			=>'Add New',
    		'add_new_item'		=>'Add New ' . $singular,
    		'edit'				=>'Edit',
    		'edit_item'			=>'Edit ' . $singular,
    		'new_item'			=>'New' . $singular,
    		'view'				=>'View ' . $singular,
    		'view_item'			=>'View ' . $singular,
    		'search_term'		=>'Search ' . $plural,
    		'parent'			=>'Parent' .$singular,
    		'not_found'			=>'No ' . $plural . ' found',
    		'not_found_in_trash'=>'No ' . $plural . ' in Trash'
    	);

    	$args = array(
    		'labels'              => $labels,
    		'public'              => true,
    		'publicly_queryable'  => true,
    		'exclude_from_search' => false,
    		'show_in_nav_menus'   => true,
    		'show_ui'             => true,
    		'show_in_menu'        => true,
    		'show_in_admin_bar'   => true,
    		'menu_position'       => 10,
    		'menu_icon'           => 'dashicons-search',
    		'can_export'          => true,
    		'delete_with_user'    => false,
    		'hierarchical'        => true,
    		'has_archive'         => true,
    		'query_var'           => true,
    		'capability_type'     => 'post',
    		'map_meta_cap'        => true,
	        // 'capabilities' => array(),
    		'rewrite'             => array( 
    			'slug' => 'symbiota',
    			'with_front' => true,
    			'pages' => true,
    			'feeds' => true,
    		),
    		'supports'            => array( 
    			'title' ,
    		)
    	);


    	register_post_type($slug1, $args);


    }
    add_action('init', 'symbiota_post_type_search');


    add_filter('manage_edit-symbiota_search_columns', 'symbiota_set_columns');
    add_action('manage_symbiota_search_posts_custom_column', 'symbiota_custom_column', 10, 2);

    function symbiota_set_columns($columns) {
    	return $columns
    	+ array('symbiota_shortcode' => __('Shortcode'));
    }

    function symbiota_custom_column($column, $post_id) {
    	$slider_meta = get_post_meta($post_id, "_selected_items", true);
    	echo "[symbiota id='$post_id' /]";
    /*switch ($column) {
        case 'slider_shortcode':
            echo do_shortcode("[Shortcode id='post_id' /]"); 
            echo "[first_short_code id='$post_id' /]";
            break;
        }*/
    }

    ?>