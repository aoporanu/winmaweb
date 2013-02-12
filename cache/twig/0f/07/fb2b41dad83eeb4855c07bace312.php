<?php

/* user/actionsCompany.twig */
class __TwigTemplate_0f07fb2b41dad83eeb4855c07bace312 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layouts/ajax.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        $context["actionsMenu"] = "company";
        // line 6
        $this->env->loadTemplate("user/actionsMenu.twig")->display($context);
        // line 7
        echo "<script type=\"text/javascript\">
    function updateMarkerPosition(latLng) {
      document.getElementById('g_lat').value=latLng.lat();
      document.getElementById('g_lng').value=latLng.lng();
    }
    function initialize() {
          var latLng = new google.maps.LatLng(1.2940447772307804, 103.830810546875);
          var mlatLng = ";
        // line 14
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
        // line 15
        echo "
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: mlatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          });
          var marker = new google.maps.Marker({
            position: mlatLng,
            title: 'Drag to your business location',
            ";
        // line 24
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ((($this->getAttribute($this->getAttribute($_form_, "values"), "g_lat") != 0) || ($this->getAttribute($this->getAttribute($_form_, "values"), "g_lng") != 0))) {
            // line 25
            echo "            map:map,            
            ";
        }
        // line 27
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
      script.src = \"http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize\";
      document.body.appendChild(script);
    }
  
    
    // Onload handler to fire off the app.
    ";
        // line 62
        if (isset($context["imgajax"])) { $_imgajax_ = $context["imgajax"]; } else { $_imgajax_ = null; }
        if ((!$_imgajax_)) {
            // line 63
            echo "        window.onload = loadScript;
    //google.maps.event.addDomListener(window, 'load', initialize);
    ";
        } else {
            // line 66
            echo "        \$(function() {
            loadScript();
            //initialize();
        });
    ";
        }
        // line 71
        echo "</script>
<br /><br /><br />
";
        // line 73
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 74
            echo "            <div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong>
                ";
            // line 75
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if (($this->getAttribute($this->getAttribute($_form_, "errors"), "g_lat") || $this->getAttribute($this->getAttribute($_form_, "errors"), "g_lng"))) {
                // line 76
                echo "                    <br /><br />Please select the location of the business on the map.
                ";
            }
            // line 78
            echo "            </div>
        ";
        }
        // line 80
        echo "        ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 81
            echo "            <div class=\"infotip\"><strong>Success</strong><br /><br />Company edited successfully</div>
        ";
        }
        // line 83
        echo "        <form enctype=\"multipart/form-data\" action=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=company"), ), "method"), "html", null, true);
        echo "\" method=\"post\">
\t\t\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t\t\t<div class=\"inv\">
\t\t\t\t\t\t\t";
        // line 87
        echo "\t\t\t\t\t\t\t";
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("g_lat", $this->getAttribute($this->getAttribute($_form_, "values"), "g_lat"), "hidden", ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t";
        // line 88
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("g_lng", $this->getAttribute($this->getAttribute($_form_, "values"), "g_lng"), "hidden", ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\"label label_big\"><label for=\"company_name\">Company name:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
        // line 93
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("company_name", $this->getAttribute($this->getAttribute($_form_, "values"), "company_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t";
        // line 94
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
        // line 100
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("vat_number", $this->getAttribute($this->getAttribute($_form_, "values"), "vat_number"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t";
        // line 101
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
        // line 107
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("phone", $this->getAttribute($this->getAttribute($_form_, "values"), "phone"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t";
        // line 108
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "phone"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
        // line 119
        echo "\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t<div class=\"label label_big\"><label for=\"address\">Address:</label></div>
\t\t\t\t\t\t\t<div class=\"input\">
\t\t\t\t\t\t\t\t";
        // line 122
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("address", $this->getAttribute($this->getAttribute($_form_, "values"), "address"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t";
        // line 123
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
        // line 129
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("city", $this->getAttribute($this->getAttribute($_form_, "values"), "city"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t";
        // line 130
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
        // line 136
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("county", $this->getAttribute($this->getAttribute($_form_, "values"), "county"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t";
        // line 137
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
        // line 143
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("postcode", $this->getAttribute($this->getAttribute($_form_, "values"), "postcode"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t";
        // line 144
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
        // line 150
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("country", $this->getAttribute($this->getAttribute($_form_, "countries"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "country"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t";
        // line 151
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
\t\t\t\t\t\t<div class=\"left\"><input type=\"submit\" rel=\"mda\" class=\"g-button g-button-submit modal-ajax-submit\" value=\"Edit\" /></div>
\t\t\t\t\t</div>
        </form>
";
    }

    public function getTemplateName()
    {
        return "user/actionsCompany.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
