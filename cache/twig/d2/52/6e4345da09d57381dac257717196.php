<?php

/* myaccount/contract/step1.twig */
class __TwigTemplate_d2526e4345da09d57381dac257717196 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'css' => array($this, 'block_css'),
            'js' => array($this, 'block_js'),
            'content_page' => array($this, 'block_content_page'),
            'right_side' => array($this, 'block_right_side'),
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
    public function block_css($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        if (isset($context["imgajax"])) { $_imgajax_ = $context["imgajax"]; } else { $_imgajax_ = null; }
        if ((!$_imgajax_)) {
            // line 6
            echo "        ";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 7
            echo "    ";
        }
    }

    // line 9
    public function block_js($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        if (isset($context["imgajax"])) { $_imgajax_ = $context["imgajax"]; } else { $_imgajax_ = null; }
        if ((!$_imgajax_)) {
            // line 11
            echo "        ";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 12
            echo "    ";
        }
    }

    // line 15
    public function block_content_page($context, array $blocks = array())
    {
        // line 16
        echo "<script type=\"text/javascript\">
    function updateMarkerPosition(latLng) {
      document.getElementById('g_lat').value=latLng.lat();
      document.getElementById('g_lng').value=latLng.lng();
    }
    function initialize() {
          var latLng = new google.maps.LatLng(1.2940447772307804, 103.830810546875);
          var mlatLng = ";
        // line 23
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
        // line 24
        echo "
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: mlatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          });
          var marker = new google.maps.Marker({
            position: mlatLng,
            title: 'Drag to your campsite location',
            ";
        // line 33
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ((($this->getAttribute($this->getAttribute($_form_, "values"), "g_lat") != 0) || ($this->getAttribute($this->getAttribute($_form_, "values"), "g_lng") != 0))) {
            // line 34
            echo "            map:map,            
            ";
        }
        // line 36
        echo "            draggable: true
          });
      //var infoWindow = new google.maps.InfoWindow;

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
        // line 71
        if (isset($context["imgajax"])) { $_imgajax_ = $context["imgajax"]; } else { $_imgajax_ = null; }
        if ((!$_imgajax_)) {
            // line 72
            echo "        window.onload = loadScript;
    //google.maps.event.addDomListener(window, 'load', initialize);
    ";
        } else {
            // line 75
            echo "        \$(function() {
            loadScript();
            //initialize();
        });
    ";
        }
        // line 80
        echo "</script>
    <h1>Become a Merchant</h1>
    <div class=\"ma_top\"></div>
    <div class=\"ma_content\">
      ";
        // line 85
        echo "\t\t\t";
        if (isset($context["activated"])) { $_activated_ = $context["activated"]; } else { $_activated_ = null; }
        if (($_activated_ == "on")) {
            // line 86
            echo "        <ul class=\"steps clearfix\">
            <li class=\"steps_bg steps_active clearfix\"><div class=\"no left\">1</div><div class=\"left\">Information</div></li>
            <li class=\"steps_bg steps_undone clearfix\"><div class=\"no left\">2</div><div class=\"left\">Review</div></li>
            <li class=\"steps_bg steps_undone clearfix\"><div class=\"no left\">3</div><div class=\"left\">Payment</div></li>
        </ul>
        ";
            // line 97
            echo "        ";
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if ($this->getAttribute($_form_, "errors")) {
                // line 98
                echo "            <div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong>
                ";
                // line 99
                if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
                if (($this->getAttribute($this->getAttribute($_form_, "errors"), "g_lat") || $this->getAttribute($this->getAttribute($_form_, "errors"), "g_lng"))) {
                    // line 100
                    echo "                    <br /><br />Please select the location of the business on the map.
                ";
                }
                // line 102
                echo "            </div>
        ";
            }
            // line 104
            echo "        ";
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if ($this->getAttribute($_form_, "success")) {
                // line 105
                echo "            <div class=\"infotip\"><strong>Success</strong><br /><br />Contract added successfully</div>
        ";
            }
            // line 107
            echo "        <form enctype=\"multipart/form-data\" action=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountContract", ), "method"), "html", null, true);
            echo "\" method=\"post\">
\t\t\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t\t\t<div class=\"inv\">
\t\t\t\t\t\t\t";
            // line 111
            echo "\t\t\t\t\t\t\t";
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("g_lat", $this->getAttribute($this->getAttribute($_form_, "values"), "g_lat"), "hidden", ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t";
            // line 112
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("g_lng", $this->getAttribute($this->getAttribute($_form_, "values"), "g_lng"), "hidden", ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\"label label_big\"><label for=\"company_name\">Company name:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
            // line 117
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("company_name", $this->getAttribute($this->getAttribute($_form_, "values"), "company_name"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t";
            // line 118
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "company_name"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\"label label_big\"><label for=\"vat_number\">Vat number:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
            // line 124
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("vat_number", $this->getAttribute($this->getAttribute($_form_, "values"), "vat_number"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t";
            // line 125
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "vat_number"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\"label label_big\"><label for=\"phone\">Company phone:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
            // line 131
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("phone", $this->getAttribute($this->getAttribute($_form_, "values"), "phone"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t";
            // line 132
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "phone"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
            // line 143
            echo "\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\"label label_big\"><label for=\"address\">Address:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
            // line 146
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("address", $this->getAttribute($this->getAttribute($_form_, "values"), "address"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t";
            // line 147
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "address"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\"label label_big\"><label for=\"city\">City:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
            // line 153
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("city", $this->getAttribute($this->getAttribute($_form_, "values"), "city"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t";
            // line 154
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "city"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\"label label_big\"><label for=\"county\">County:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
            // line 160
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("county", $this->getAttribute($this->getAttribute($_form_, "values"), "county"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t";
            // line 161
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "county"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\"label label_big\"><label for=\"postcode\">Postal code:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
            // line 167
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("postcode", $this->getAttribute($this->getAttribute($_form_, "values"), "postcode"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t";
            // line 168
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "postcode"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\"label label_big\"><label for=\"country\">Country:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
            // line 174
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("country", $this->getAttribute($this->getAttribute($_form_, "countries"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "country"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t";
            // line 175
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "country"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div style=\"width:600px\">Add a marker exactly where the business is located, please zoom in and double click the map where you'd like the marker to be. </div>
\t\t\t\t\t\t\t<div id=\"map\" align=\"center\" style=\"width: 600px; height: 300px;margin-top:15px; position: relative;overflow: hidden;\"></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t\t\t<div class=\"label label_big\"><label>&nbsp;</label></div>
\t\t\t\t\t\t<div class=\"right\"><br/><br/><input type=\"submit\" rel=\"mda\" class=\"g-button g-button-submit \" value=\"Next step\" />&nbsp;&nbsp;&nbsp;</div>
\t\t\t\t\t</div>
        </form>
      ";
        } else {
            // line 189
            echo "        We are sorry but the request merchant account is inactive at this moment, please check back later!
      ";
        }
        // line 191
        echo "    </div>
    <div class=\"ma_bottom\"></div>
";
    }

    // line 195
    public function block_right_side($context, array $blocks = array())
    {
        // line 196
        echo "    ";
        if (isset($context["imgajax"])) { $_imgajax_ = $context["imgajax"]; } else { $_imgajax_ = null; }
        if ((!$_imgajax_)) {
            // line 197
            echo "        ";
            $context["ma_menu"] = "contract";
            // line 198
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 199
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/contract/step1.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
