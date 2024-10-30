<?php

add_action('wp_head', 'hbck_add_head'); 
add_action('init', 'hbck_reg_jquery');

function hbck_get_global_options(){  
      
    $hbck_option = array();  
  
    // collect option names as declared in hbck_get_settings()  
    $hbck_option_names = array (  
        'hbck_options_two',   
        'hbck_options_two_settings' 
    );  
  
    // loop for get_option  
    foreach ($hbck_option_names as $hbck_option_name) {  
        if (get_option($hbck_option_name)!= FALSE) {  
            $option     = get_option($hbck_option_name);  
              
            // now merge in main $hbck_option array!  
            $hbck_option = array_merge($hbck_option, $option);  
        }  
    }     
      
return $hbck_option;  
} 

function hbck_reg_jquery() {
    wp_enqueue_script('jquery');            
}

function hbck_add_head() {
    $hbck_option = hbck_get_global_options();
get_option('hbck_options');
    // clean URL
    $siteurl = get_site_url();
    //make everything play nice
preg_match('@^(?:http://)?([^/]+)@i',
    "$siteurl", $matches);
$siteurl = $matches[1];
    
    $top = $hbck_option['hbck_from_top'];
    
    if ($hbck_option['hbck_side'] == "Left") {
        $side = "left";
    } 
    else {
        $side = "right";
    }
    
    if ($hbck_option['hbck_side'] == "Left") {
        $imagem_side = "right";
    } 
    else {
        $imagem_side = "left";
    }
    
    if ($hbck_option['hbck_image'] == "Green Tick") {
        $image_option = "heartbleed-check.png";
        }
    else {
        $image_option = "hbsheild.png";
        }
    
    if ($hbck_option['hbck_enable'] == "1") {
    echo "
        <!-- Heartbleed Check v1.0 -->
        <script type=\"text/javascript\">
            //<![CDATA[
            jQuery(document).ready(function(){
                jQuery(\"body\").append(\"<div id=\\\"hbchox\\\"></div>\");
                jQuery(\"#hbchox\").css({'position' : 'fixed', 'top' : '$top', 'width' : '85px', 'height' : '103px', 'z-index' : '1000', 'cursor' : 'pointer', 'background' : ' url(" . WP_PLUGIN_URL . "/heartbleed-bug-floating-tab/images/$image_option) no-repeat scroll $imagem_side top', '$side' : '0'});
                jQuery(\"#hbchox\").click(function () { 
                  window.open('http://filippo.io/Heartbleed/#$siteurl');
                });
            });
            //]]>
        </script>
        <!-- /Heartbleed Check -->
    ";
    
    }
}