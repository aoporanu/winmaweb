<?php

/* profile_box.twig */
class __TwigTemplate_92915d519a5727e1f546fb412dc2e77a extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (isset($context["lat"])) { $_lat_ = $context["lat"]; } else { $_lat_ = null; }
        if (isset($context["lng"])) { $_lng_ = $context["lng"]; } else { $_lng_ = null; }
        if (($_lat_ && $_lng_)) {
            // line 2
            echo "<script type=\"text/javascript\">
    var geocoder;
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng( ";
            // line 7
            if (isset($context["lat"])) { $_lat_ = $context["lat"]; } else { $_lat_ = null; }
            echo twig_escape_filter($this->env, $_lat_, "html", null, true);
            echo ", ";
            if (isset($context["lng"])) { $_lng_ = $context["lng"]; } else { $_lng_ = null; }
            echo twig_escape_filter($this->env, $_lng_, "html", null, true);
            echo ");
        var mapOptions = {
             zoom: 8,
             center: latlng,
             mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        var marker = new google.maps.Marker({
            position: latlng,
            title: 'Positioned exactly at your address',
            map: map,
            draggable: true
        });
    }
    
    /*function codeAddress() {
        var address = ";
            // line 23
            if (isset($context["addr"])) { $_addr_ = $context["addr"]; } else { $_addr_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_addr_, "postcode"), "html", null, true);
            echo ";
        geocoder.geocode( {'address': address}, function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
             } else {
                 alert('Geocode was not succesfull for the following reason: '+status);
             }
         });
    }*/
    function loadScript() {
      var script = document.createElement(\"script\");
      script.type = \"text/javascript\";
      script.src = \"https://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize\";
      document.body.appendChild(script);
    }
  
    
    // Onload handler to fire off the app.
    ";
            // line 45
            if (isset($context["imgajax"])) { $_imgajax_ = $context["imgajax"]; } else { $_imgajax_ = null; }
            if ((!$_imgajax_)) {
                // line 46
                echo "        window.onload = loadScript;
    //google.maps.event.addDomListener(window, 'load', initialize);
    ";
            } else {
                // line 49
                echo "        \$(function() {
            loadScript();
            //initialize();
        });
    ";
            }
            // line 54
            echo "</script>
";
        }
        // line 56
        echo "<div class=\"clearfix\">
\t<div class=\"form-global clearfix\">
\t\t<div class=\"profile_left\">
\t\t\t";
        // line 59
        if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
        if ($_image_) {
            // line 60
            echo "\t\t\t<img src=\"";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "dir"), "html", null, true);
            echo "/thumb120x67/";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "file_name"), "html", null, true);
            echo "_";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "id"), "html", null, true);
            echo ".";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "ext"), "html", null, true);
            echo "\" width=\"200\" />
\t\t\t";
        } else {
            // line 62
            echo "\t\t\t<img src=\"/images/logo_final.png\" width=\"200\" />
\t\t\t";
        }
        // line 64
        echo "\t\t</div>
\t\t<div class=\"profile_right\"
\t\t\t\t ";
        // line 66
        if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
        if ($_group_) {
            // line 67
            echo "\t\t\t\t style=\"background: url('/images/site/";
            if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
            echo twig_escape_filter($this->env, $_group_, "html", null, true);
            echo "-badge.png') no-repeat top right\"
\t\t\t\t ";
        }
        // line 69
        echo "\t\t\t\t >
\t\t\t<div class=\"profile_acc_descr\" style=\"font-size: 16px;\">
\t\t\t\t<!--<strong>";
        // line 71
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "username"), "html", null, true);
        echo "</strong>-->
\t\t\t\t";
        // line 72
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if ($this->getAttribute($_user_, "my_status")) {
            // line 73
            echo "\t\t\t\t - ";
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_user_, "my_status"), "html", null, true);
            echo "
\t\t\t\t";
        }
        // line 75
        echo "\t\t\t</div>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">";
        // line 77
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "first_name"), "html", null, true);
        echo " ";
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "last_name"), "html", null, true);
        echo "</label>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">Member since</label>
\t\t\t<div class=\"profile_acc_descr\">";
        // line 80
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "created_at"), "html", null, true);
        echo "</div>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">Last time online</label>
\t\t\t<div class=\"profile_acc_descr\">";
        // line 83
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "last_login"), "html", null, true);
        echo "</div>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<br/>
\t\t\t<label class=\"profile_acc_label\">ABOUT ME</label>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">E-mail</label>
\t\t\t<div class=\"profile_acc_descr\">";
        // line 89
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "email"), "html", null, true);
        echo "</div>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">Gender</label>
\t\t\t<div class=\"profile_acc_descr\">";
        // line 92
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "gender"), "html", null, true);
        echo "</div>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">Age</label>
\t\t\t<div class=\"profile_acc_descr\">";
        // line 95
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "age"), "html", null, true);
        echo "</div>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<br/>
\t\t\t<label class=\"profile_acc_descr\"><strong>CONTACT INFORMATION</strong></label>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">Phone</label>
\t\t\t<div class=\"profile_acc_descr\">";
        // line 101
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "phone"), "html", null, true);
        echo "</div>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">Address</label>
\t\t\t<div class=\"profile_acc_descr\">";
        // line 104
        if (isset($context["addr"])) { $_addr_ = $context["addr"]; } else { $_addr_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_addr_, "address"), "html", null, true);
        echo "</div>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">City</label>
\t\t\t<div class=\"profile_acc_descr\">";
        // line 107
        if (isset($context["addr"])) { $_addr_ = $context["addr"]; } else { $_addr_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_addr_, "city"), "html", null, true);
        echo "</div>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">Province/County</label>
\t\t\t<div class=\"profile_acc_descr\">";
        // line 110
        if (isset($context["addr"])) { $_addr_ = $context["addr"]; } else { $_addr_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_addr_, "county"), "html", null, true);
        echo "</div>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">Country</label>
\t\t\t<div class=\"profile_acc_descr\">";
        // line 113
        if (isset($context["country"])) { $_country_ = $context["country"]; } else { $_country_ = null; }
        echo twig_escape_filter($this->env, $_country_, "html", null, true);
        echo "</div>
\t\t\t<div class=\"clearall\"></div>
\t\t\t<label class=\"profile_acc_label\">Postal Code</label>
\t\t\t<div class=\"profile_acc_descr\">";
        // line 116
        if (isset($context["addr"])) { $_addr_ = $context["addr"]; } else { $_addr_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_addr_, "postcode"), "html", null, true);
        echo "</div>
            <div class=\"clearall\"></div>
            <br />
            <label class=\"profile_acc_descr\"><strong>My Network</strong></label>
            <div class=\"clearall\"></div>
            <label class=\"profile_acc_label\">Total referrals</label>
            <div class=\"profile_acc_descr\" id=\"referral_count\"></div>
\t\t\t<div class=\"clearall\"></div>
            <label class=\"profile_acc_label\">My Referral ID</label>
            <div class=\"profile_acc_descr\">";
        // line 125
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "ref_id"), "html", null, true);
        echo "</div>
            <div class=\"clearall\"></div>
\t\t\t";
        // line 127
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if (($this->getAttribute($this->getAttribute($_app_, "user"), "id") != $this->getAttribute($_user_, "id"))) {
            // line 128
            echo "\t\t\t\t<a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@RequestFriendship?id=" . $this->getAttribute($_user_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-share modal-normal\" title=\"Request Friendship\">Request Friendship</a>
\t\t\t";
        }
        // line 130
        echo "            <div class=\"clearall\"></div>
            ";
        // line 131
        if (isset($context["lat"])) { $_lat_ = $context["lat"]; } else { $_lat_ = null; }
        if (isset($context["lng"])) { $_lng_ = $context["lng"]; } else { $_lng_ = null; }
        if (($_lat_ && $_lng_)) {
            // line 132
            echo "                <div id=\"map_canvas\"></div>
            ";
        }
        // line 134
        echo "\t\t</div>
\t\t<div class=\"clearall\"></div>
\t</div>
</div>
<script type=\"text/javascript\">
    \$(document).ready(function() {
        \$('#referral_count').load('/my-account/get-my-referrals/'+";
        // line 140
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "id"), "html", null, true);
        echo " );
        \$('#map_canvas').css('height', '300px');
    });
</script>";
    }

    public function getTemplateName()
    {
        return "profile_box.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
