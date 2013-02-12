<?php

/* myaccount/products/add.twig */
class __TwigTemplate_e203e2120812da6f346e657e226503e7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content_page' => array($this, 'block_content_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getContext($context, "imgajax")) ? ("layouts/ajax.twig") : ("layouts/layout.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content_page($context, array $blocks = array())
    {
        // line 11
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 12
            echo "\t<div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong>
\t\t";
            // line 13
            if (isset($context["err_img"])) { $_err_img_ = $context["err_img"]; } else { $_err_img_ = null; }
            if ($_err_img_) {
                echo "<br />";
                if (isset($context["err_img"])) { $_err_img_ = $context["err_img"]; } else { $_err_img_ = null; }
                echo twig_escape_filter($this->env, $_err_img_, "html", null, true);
            }
            // line 14
            echo "\t</div>
";
        }
        // line 16
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 17
            echo "\t<div class=\"infotip\"><strong>Success</strong><br /><br />Product added successfully<br /><a class=\"modal-close\" href=\"#\">Close</a></div>
";
        } else {
            // line 19
            echo "<script type=\"text/javascript\">
    document.myForm.remLen2.value = 200 - document.myForm.short_description.value.length;
    function textCounter(field,cntfield,maxlimit) {
        if (field.value.length > maxlimit) {// if too long...trim it!
            field.value = field.value.substring(0, maxlimit);
        // otherwise, update 'characters left' counter
        }else{
            cntfield.value = maxlimit - field.value.length;
        }
}
    function updateMarkerPosition(latLng) {
      document.getElementById('g_lat').value=latLng.lat();
      document.getElementById('g_lng').value=latLng.lng();
    }
    function initialize() {
          var latLng = new google.maps.LatLng(1.2940447772307804, 103.830810546875);
          var mlatLng = ";
            // line 35
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if ((($this->getAttribute($this->getAttribute($_form_, "values"), "g_lat") != 0) || ($this->getAttribute($this->getAttribute($_form_, "values"), "g_lng") != 0))) {
                echo "new google.maps.LatLng(";
                if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_form_, "values"), "g_lat"), "html", null, true);
                echo ", ";
                if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_form_, "values"), "g_lng"), "html", null, true);
                echo ")";
            } else {
                echo "latLng";
            }
            // line 36
            echo "
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: mlatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          });
          
          ";
            // line 44
            echo "\t\t\t\t\t";
            if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
            if ($this->getAttribute($_userObj_, "hasRole", array("SHOP", ), "method")) {
                // line 45
                echo "                ";
                // line 46
                echo "\t\t\t\t\t\t\t\tvar mda = 0;
                var masa = eval(";
                // line 47
                if (isset($context["for_masa"])) { $_for_masa_ = $context["for_masa"]; } else { $_for_masa_ = null; }
                echo $_for_masa_;
                echo ");

                var mlatLng = new google.maps.LatLng(masa[mda]['CompanyAddress']['latitude'], masa[mda]['CompanyAddress']['longitude'])
                var marker = new google.maps.Marker({
                    position: mlatLng,
                    title: 'Drag to your deal location',
                    map:map,            
                    draggable: true
                });
                        
          ";
            } else {
                // line 58
                echo "          var marker = new google.maps.Marker({
            position: mlatLng,
            title: 'Drag to your deal location',
            ";
                // line 61
                if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
                if ((($this->getAttribute($this->getAttribute($_form_, "values"), "g_lat") != 0) || ($this->getAttribute($this->getAttribute($_form_, "values"), "g_lng") != 0))) {
                    // line 62
                    echo "            map:map,            
            ";
                }
                // line 64
                echo "            draggable: true
          });
          ";
            }
            // line 67
            echo "      //var infoWindow = new google.maps.InfoWindow;

      // Update current position info.

      google.maps.event.addListener(map, 'click', function(event) {
        marker.setMap(map);
        marker.setPosition(event.latLng);
        map.setCenter(marker.getPosition());
        updateMarkerPosition(marker.getPosition());
      });
      
      // Add dragging event listeners.
      google.maps.event.addListener(marker, 'click', function() {

      });

      google.maps.event.addListener(marker, 'drag', function() {
      });

      google.maps.event.addListener(marker, 'dragend', function() {
        map.setCenter(marker.getPosition());
        updateMarkerPosition(marker.getPosition());
      });
    }
    function loadScript() {
      var script = document.createElement(\"script\");
      script.type = \"text/javascript\";
      script.src = \"https://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize\";
      document.body.appendChild(script);
    }
  
    
    // Onload handler to fire off the app.
    ";
            // line 100
            if (isset($context["imgajax"])) { $_imgajax_ = $context["imgajax"]; } else { $_imgajax_ = null; }
            if ((!$_imgajax_)) {
                // line 101
                echo "        window.onload = loadScript;
    //google.maps.event.addDomListener(window, 'load', initialize);
    ";
            } else {
                // line 104
                echo "        \$(function() {
            loadScript();
            //initialize();
        });
    ";
            }
            // line 109
            echo "\t\$('.link_after_label:hover').css('text-decoration', 'underline');
</script>
<form enctype=\"multipart/form-data\" action=\"";
            // line 111
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myProductsAdd", ), "method"), "html", null, true);
            echo "\" method=\"post\" name=\"myForm\">
\t<div class=\"form-global clearfix\">
\t\t<!--<div class=\"clearfix\">
\t\t\t";
            // line 115
            echo "\t\t\t<div class=\"label label_big\"><label for=\"contract\">Contract: <em>(file need to be in .pdf format)</em></label></div>
\t\t\t<div class=\"input\">
\t\t\t\t<input name=\"contract\" type=\"file\" id=\"contract\" />
\t\t\t\t";
            // line 118
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "contract"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>-->
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"name\">Name of Deal Offer:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 124
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("name", $this->getAttribute($this->getAttribute($_form_, "values"), "name"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 125
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "name"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t";
            // line 129
            echo "\t\t";
            if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
            if ($this->getAttribute($_userObj_, "hasRole", array("SHOP", ), "method")) {
                // line 130
                echo "\t\t\t<script type=\"text/javascript\">
\t\t\t\t\t\$(function() {
\t\t\t\t\t\t\t//var mda = \$('#merchant_user_id').val();
\t\t\t\t\t\t\tvar mda = 0;
\t\t\t\t\t\t\tvar masa = eval(";
                // line 134
                if (isset($context["for_masa"])) { $_for_masa_ = $context["for_masa"]; } else { $_for_masa_ = null; }
                echo $_for_masa_;
                echo ");
\t\t\t\t\t\t\t\$('#address').val(masa[mda]['CompanyAddress']['address']);
\t\t\t\t\t\t\t\$('#city').val(masa[mda]['CompanyAddress']['city']);
\t\t\t\t\t\t\t\$('#county').val(masa[mda]['CompanyAddress']['county']);
\t\t\t\t\t\t\t\$('#postcode').val(masa[mda]['CompanyAddress']['postcode']);
\t\t\t\t\t\t\t\$('#g_lat').val(masa[mda]['CompanyAddress']['latitude']);
\t\t\t\t\t\t\t\$('#g_lng').val(masa[mda]['CompanyAddress']['longitude']);
\t\t\t\t\t\t\t\$('#phone').val(masa[mda]['phone']);

\t\t\t\t\t\t\t//\$('#merchant_user_id').live('change', function(e){
\t\t\t\t\t\t\t//    var oid = \$(this).val();
\t\t\t\t\t\t\t//    \$('#address').val(masa[oid]['CompanyAddress']['address']);
\t\t\t\t\t\t\t//    \$('#city').val(masa[oid]['CompanyAddress']['city']);
\t\t\t\t\t\t\t//    \$('#county').val(masa[oid]['CompanyAddress']['county']);
\t\t\t\t\t\t\t//    \$('#postcode').val(masa[oid]['CompanyAddress']['postcode']);
\t\t\t\t\t\t\t//    \$('#g_lat').val(masa[oid]['CompanyAddress']['latitude']);
\t\t\t\t\t\t\t//    \$('#g_lng').val(masa[oid]['CompanyAddress']['longitude']);
\t\t\t\t\t\t\t//    \$('#phone').val(masa[oid]['phone']);
\t\t\t\t\t\t\t//})
\t\t\t\t\t});
\t\t\t</script>
\t\t\t<div class=\"clearfix\">
\t\t\t\t<div class=\"label label_big\"><label for=\"merchant_ref_id\">Merchant Refferal ID:</label></div>
\t\t\t\t<div class=\"input\">
\t\t\t\t\t";
                // line 158
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("merchant_ref_id", $this->getAttribute($this->getAttribute($_app_, "user"), "ref_id"), ), "method"), "html", null, true);
                echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t";
            }
            // line 162
            echo "\t\t";
            if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
            if (($this->getAttribute($_userObj_, "hasRole", array("AGENT", ), "method") && (!$this->getAttribute($_userObj_, "hasRole", array("SHOP", ), "method")))) {
                // line 163
                echo "\t\t<div class=\"clearfix\">
\t\t\t";
                // line 173
                echo "\t\t\t<div class=\" label label_big\"><label for=\"merchant_user_id\">Merchant's Referral ID:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
                // line 175
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("merchant_ref_id", $this->getAttribute($this->getAttribute($_form_, "values"), "merchant_ref_id"), ), "method"), "html", null, true);
                echo "
\t\t\t\t";
                // line 176
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "merchant_ref_id"), ), "method"), "html", null, true);
                echo "
\t\t\t</div>
\t\t</div>
\t\t";
            }
            // line 180
            echo "\t\t<div class=\"clearfix\">
\t\t\t<div class=\"label label_big\"><label for=\"address\">Phone:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 183
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("phone", $this->getAttribute($this->getAttribute($_form_, "values"), "phone"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 184
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "phone"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"page_subtitle_wrapper clearfix\">
\t\t\t<span class=\"page_subtitle_two\">Deal Location</span>
\t\t</div>
\t\t<div class=\"inv\">
\t\t\t";
            // line 192
            echo "\t\t\t";
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("g_lat", $this->getAttribute($this->getAttribute($_form_, "values"), "g_lat"), "hidden", ), "method"), "html", null, true);
            echo "
\t\t\t";
            // line 193
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("g_lng", $this->getAttribute($this->getAttribute($_form_, "values"), "g_lng"), "hidden", ), "method"), "html", null, true);
            echo "
\t\t</div>
\t\t<div style=\"color:#666\">Please provide the exact location of the Deal Offer</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\"label label_big\"><label for=\"address\">Address:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 199
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("address", $this->getAttribute($this->getAttribute($_form_, "values"), "address"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 200
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "address"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\"label label_big\"><label for=\"city\">City:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 206
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("city", $this->getAttribute($this->getAttribute($_form_, "values"), "city"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 207
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "city"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\"label label_big\"><label for=\"county\">Province/County:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 213
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("county", $this->getAttribute($this->getAttribute($_form_, "values"), "county"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 214
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "county"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\"label label_big\"><label for=\"postcode\">Postal Code:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 220
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("postcode", $this->getAttribute($this->getAttribute($_form_, "values"), "postcode"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 221
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "postcode"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\"label label_big\"><label for=\"country\">Country:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 227
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("country", $this->getAttribute($this->getAttribute($_form_, "countries"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "country"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 228
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "country"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div style=\"width:600px\">Add a marker exactly where the deal is located, please zoom in and double click the map where you'd like the marker to be. </div>
\t\t\t<div id=\"map\" align=\"center\" style=\"width: 600px; height: 300px;margin-top:15px; position: relative;overflow: hidden;\"></div>
\t\t</div>
\t\t<br /><br />
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"min_sold\">Minimum # Sold:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 239
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("min_sold", $this->getAttribute($this->getAttribute($_form_, "values"), "min_sold"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 240
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "min_sold"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"></div>
\t\t\t<div class=\"input\">
\t\t\t\t<div style=\"color:#666\">Minimum number of deals needed to be sold before the deal offer is active.</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"max_sold\">Maximum # Sold per Member:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 252
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("max_sold", $this->getAttribute($this->getAttribute($_form_, "values"), "max_sold"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 253
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "max_sold"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"></div>
\t\t\t<div class=\"input\">
\t\t\t\t<div style=\"color:#666\">Maximum number of deal offers that a member may buy.</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"prices-box\">
\t\t\t";
            // line 263
            if (isset($context["no"])) { $_no_ = $context["no"]; } else { $_no_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(1, $_no_));
            foreach ($context['_seq'] as $context["_key"] => $context["x"]) {
                // line 264
                echo "\t\t\t\t<div class=\"price-box\">
\t\t\t\t\t<input type=\"hidden\" name=\"price[]\" id=\"price\" value=\"1\" />
\t\t\t\t\t<div style=\"float: right;\"><strong>This is the Price #";
                // line 266
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $_x_, "html", null, true);
                echo " of the Deal Offer</strong></div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div style=\"border:1px solid #cacaca;padding:5px;margin:10px 0;\">
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\"label label_big\"><label for=\"offer_price_name_";
                // line 270
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $_x_, "html", null, true);
                echo "\">Name of Deal Offer #";
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $_x_, "html", null, true);
                echo ":</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
                // line 272
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array(("offer_price_name_" . $_x_), $this->getAttribute($_price_form_, "getValue", array(("offer_price_name_" . $_x_), ), "method"), ), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t";
                // line 273
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_price_form_, "getMessages", array(("offer_price_name_" . $_x_), ), "method"), ), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\" label label_big\"></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t<div style=\"color:#666\">This is the name of the deal offer under the First Price it will have (This is to allow Merchants to change the pricing on the same deal, but for example at different times)  Eg. A Merchant wishes to sell a vacation package at one price on weekends, another on weekdays.</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\" label label_big\"><label for=\"producer_price_";
                // line 283
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $_x_, "html", null, true);
                echo "\">Original Price:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
                // line 285
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array(("producer_price_" . $_x_), $this->getAttribute($_price_form_, "getValue", array(("producer_price_" . $_x_), ), "method"), ), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t";
                // line 286
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_price_form_, "getMessages", array(("producer_price_" . $_x_), ), "method"), ), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\" label label_big\"></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t<div style=\"color:#666\">Note: This is the normal cost of the product or service you are providing through WinMaWeb before any discounts are applied.</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\" label label_big\"><label for=\"discount_";
                // line 296
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $_x_, "html", null, true);
                echo "\">Discount %:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
                // line 298
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array(("discount_" . $_x_), $this->getAttribute($_price_form_, "getValue", array(("discount_" . $_x_), ), "method"), ), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t";
                // line 299
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_price_form_, "getMessages", array(("discount_" . $_x_), ), "method"), ), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\" label label_big\"></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t<div style=\"color:#666\">Please only input numbers with no units (no percentages, no currency symbols)</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\" label label_big\"><label>Sale Price on WinMaWeb:</label></div>
\t\t\t\t\t\t\t<div class=\"input\" style=\"padding:4px;\" id=\"discount_";
                // line 310
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $_x_, "html", null, true);
                echo "_price\">\$ <span class=\"s\">0</span> <a href=\"#\" class=\"calc\" rel=\"";
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $_x_, "html", null, true);
                echo "\">Calculate</a></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\" label label_big\"></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t<div style=\"color:#666\">This is the sale price that members will see and purchase at on WinMaWeb.</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\" label label_big\"><label for=\"stock_";
                // line 319
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $_x_, "html", null, true);
                echo "\">WinMaWeb Stock:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
                // line 321
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array(("stock_" . $_x_), $this->getAttribute($_price_form_, "getValue", array(("stock_" . $_x_), ), "method"), ), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t";
                // line 322
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_price_form_, "getMessages", array(("stock_" . $_x_), ), "method"), ), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\" label label_big\"></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t<div style=\"color:#666\">This is the maximum number of deal offers that WinMaWeb may sell of your product and service.</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\" label label_big\"><label for=\"expire_";
                // line 332
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $_x_, "html", null, true);
                echo "\">Price #";
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $_x_, "html", null, true);
                echo " Expires on:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
                // line 335
                echo "\t\t\t\t\t\t\t\t<input type=\"text\" name=\"";
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, ("expire_" . $_x_), "html", null, true);
                echo "\" id=\"";
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, ("expire_" . $_x_), "html", null, true);
                echo "\" value=\"";
                if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_price_form_, "getValue", array(("expire_" . $_x_), ), "method"), "html", null, true);
                echo "\" class=\"exdate\" />
\t\t\t\t\t\t\t\t";
                // line 336
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_price_form_, "getMessages", array(("expire_" . $_x_), ), "method"), ), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\" label label_big\"></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t<div style=\"color:#666\">This is the Voucher expiration date and time.  The Voucher will no longer be redeemable after this date and time.</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"remove-button\">
\t\t\t\t\t\t\t";
                // line 346
                if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
                if (isset($context["no"])) { $_no_ = $context["no"]; } else { $_no_ = null; }
                if ((($_x_ == $_no_) && ($_x_ > 1))) {
                    // line 347
                    echo "\t\t\t\t\t\t\t\t<a href=\"#\" class=\"remove-price\">Remove</a>
\t\t\t\t\t\t\t";
                }
                // line 349
                echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['x'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 353
            echo "\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<a class=\"g-button g-button-share add-price\" href=\"#\">Add price</a>
\t\t</div>
\t\t";
            // line 364
            echo "\t\t";
            // line 371
            echo "\t\t";
            // line 377
            echo "\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"start_time\">Start time:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 380
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("start_time", $this->getAttribute($this->getAttribute($_form_, "values"), "start_time"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 381
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "start_time"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"></div>
\t\t\t<div class=\"input\">
\t\t\t\t<div style=\"color:#666\">Server time is ";
            // line 387
            if (isset($context["now"])) { $_now_ = $context["now"]; } else { $_now_ = null; }
            echo twig_escape_filter($this->env, twig_date_format_filter($_now_), "html", null, true);
            echo " if you want to show your product imediately you need to set the start time as the server time</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"end_time\">End time:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 393
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("end_time", $this->getAttribute($this->getAttribute($_form_, "values"), "end_time"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 394
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "end_time"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
                <div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"></div>
\t\t\t<div class=\"input\">
\t\t\t\t<div style=\"color:#666\">This is when the deal offer will stop being sold on WinMaweb.</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<input type='hidden' name='isajaxrequest' id='isajaxrequest' value='0' />
\t\t\t<div class=\" label label_big\"><label for=\"photo123\">Photo:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t<input name=\"photo123\" type=\"file\" id=\"photo123\" />
\t\t\t\t";
            // line 408
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "photo123"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"tags\">Tags:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 414
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("tags", $this->getAttribute($this->getAttribute($_form_, "values"), "tags"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 415
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "tags"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
                <div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"></div>
\t\t\t<div class=\"input\">
\t\t\t\t<div style=\"color:#666\">Please be sure to hit the ENTER key after adding a tag. Your tag has not been completed properly until it is outlined with a green background.</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"terms\">Offer terms:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 427
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "textarea", array("terms", $this->getAttribute($this->getAttribute($_form_, "values"), "terms"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 428
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "terms"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
                <div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"></div>
\t\t\t<div class=\"input\">
\t\t\t\t<div style=\"color:#666\">Please explain any and all limitations and restrictions here. Some examples are; <br />1) Offer is limited to 1 deal per member. <br />2) 5 Deals must be purchased before the deal is activated. <br />3) Offer is only valid on Tuesdays at the Location on Queens Rd in Queenstown. <br />4)Vouchers must be redeemed between the 4th and 6th of July, 2012. [Please Note- Whatever is written here will also be printed on the bottom of the Vouchers to avoid confusion.]</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"short_description\">Short description:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 441
            echo "                                <textarea name=\"short_description\" wrap=\"physical\" cols=\"28\" rows=\"5\"
                                    onKeyDown=\"textCounter(document.myForm.short_description,document.myForm.remLen2,200)\"
                                    onKeyUp=\"textCounter(document.myForm.short_description,document.myForm.remLen2,200)\">";
            // line 443
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_form_, "values"), "short_description"), "html", null, true);
            echo "</textarea>
                                    <br>
                                    <input readonly type=\"text\" name=\"remLen2\" size=\"3\" maxlength=\"3\" value=\"200\">
                                    characters left
                                    <br>
\t\t\t\t";
            // line 448
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "short_description"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"description\">Description:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 454
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "textarea_editor", array("description", $this->getAttribute($this->getAttribute($_form_, "values"), "description"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 455
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "description"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\">
\t\t\t\t<div style=\"float: left;\">
\t\t\t\t\tAccept <a href=\"/Terms and Conditions.pdf\" style=\"color:#2F5BB7;text-decoration:none;\" target=\"_blank\" class=\"link_after_label\">terms and conditions</a>
\t\t\t\t</div>
\t\t\t\t<div style=\"float: right;\">
\t\t\t\t\t<input type=\"checkbox\" name=\"terms_checkbox\" id=\"terms_checkbox\" style=\"width: 20px;\" value=\"1\" />
\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t";
            // line 467
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "terms_checkbox"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t\t<div class=\"input\"></div>
\t\t</div>
\t</div>
\t<div class=\"form-global clearfix\">
\t\t<div class=\" label label_big\"><label>&nbsp;</label></div>
\t\t<div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit modal-submit-product\" value=\"Add\" /></div>
\t</div>
</form>
";
        }
        // line 478
        echo "<script type=\"text/javascript\">
\tif(\$('#terms').val() == '0') { \$('#terms').val(''); }
</script>
";
    }

    public function getTemplateName()
    {
        return "myaccount/products/add.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
