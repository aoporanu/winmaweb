<?php

/* layouts/layout_register.twig */
class __TwigTemplate_7aab5fb3c38228f0b2c1f067d88730ca extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
            'seo' => array($this, 'block_seo'),
            'css' => array($this, 'block_css'),
            'js' => array($this, 'block_js'),
            'header_info' => array($this, 'block_header_info'),
            'main_menu' => array($this, 'block_main_menu'),
            'slider' => array($this, 'block_slider'),
            'content_page_register' => array($this, 'block_content_page_register'),
            'right_side' => array($this, 'block_right_side'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"https://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
\t<head>
\t\t<title>";
        // line 4
        $this->displayBlock('page_title', $context, $blocks);
        echo "</title>
\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
\t\t<meta property=\"og:image\" content=\"https://www.winmaweb.com/images/site/header-logo-box2.png\" />
\t\t<meta property=\"og:title\" content=\"winmaweb.com\" />
\t\t<meta property=\"og:description\" content=\"winmaweb.com\" />
\t\t";
        // line 9
        $this->displayBlock('seo', $context, $blocks);
        // line 13
        echo "\t\t<meta name=\"robots\" content=\"INDEX,FOLLOW\" />
\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/global.css\" />
\t\t";
        // line 15
        $this->displayBlock('css', $context, $blocks);
        // line 17
        echo "\t\t<link rel=\"shortcut icon\" href=\"/images/favicon.ico\" />
\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/site/style.css\" />
\t\t<script type=\"text/javascript\" src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/jquery.form.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/jquery.scrollTo-1.4.2-min.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/jquery.modal.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/jquery.countdown.min.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/jquery-ui-1.8.16.custom.min.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/slides.min.jquery.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/jquery.prettyPhoto.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/product.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/function.js\"></script>
\t\t<script type=\"text/javascript\">
\t\t\tfunction initialize() {
\t\t\t\tvar latLng = new google.maps.LatLng(1.2940447772307804, 103.830810546875);
\t\t\t\tvar mlatLng = ";
        // line 32
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "User"), "Company"), 0), "CompanyAddress"), "latitude") != 0) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "User"), "Company"), 0), "CompanyAddress"), "longitude") != 0))) {
            echo "new google.maps.LatLng(";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "User"), "Company"), 0), "CompanyAddress"), "latitude"), "html", null, true);
            echo ", ";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "User"), "Company"), 0), "CompanyAddress"), "longitude"), "html", null, true);
            echo ")";
        } else {
            echo "latLng";
        }
        echo ";
\t\t\t\tvar map = new google.maps.Map(document.getElementById('map'), {
\t\t\t\t\tzoom: 14,
\t\t\t\t\tcenter: mlatLng,
\t\t\t\t\tmapTypeId: google.maps.MapTypeId.ROADMAP
\t\t\t\t});
\t\t\t\tvar marker = new google.maps.Marker({
\t\t\t\t\tposition: mlatLng,
\t\t\t\t\t";
        // line 40
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "User"), "Company"), 0), "CompanyAddress"), "latitude") != 0) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "User"), "Company"), 0), "CompanyAddress"), "longitude") != 0))) {
            // line 41
            echo "\t\t\t\t\t\tmap:map,
\t\t\t\t\t";
        }
        // line 43
        echo "\t\t\t\t\tdraggable: false
\t\t\t\t});
\t\t\t}
\t\t\tfunction loadScript() {
\t\t\t\tvar script = document.createElement(\"script\");
\t\t\t\tscript.type = \"text/javascript\";
\t\t\t\tscript.src = \"https://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize\";
\t\t\t\tdocument.body.appendChild(script);
\t\t\t}
\t\t\t// Onload handler to fire off the app.
\t\t\t";
        // line 53
        if (isset($context["ajax"])) { $_ajax_ = $context["ajax"]; } else { $_ajax_ = null; }
        if ((!$_ajax_)) {
            // line 54
            echo "\t\t\t\twindow.onload = loadScript;
\t\t\t\t//google.maps.event.addDomListener(window, 'load', initialize);
\t\t\t";
        } else {
            // line 57
            echo "\t\t\t\t\$(function() {
\t\t\t\t\tloadScript();
\t\t\t\t\t//initialize();
\t\t\t\t});
\t\t\t";
        }
        // line 62
        echo "\t\t</script>
\t\t<script type=\"text/javascript\" src=\"/js/global.js\"></script>
\t</head>
\t<body class='landing clearfix '>
\t\t";
        // line 66
        $this->displayBlock('js', $context, $blocks);
        // line 68
        echo "\t\t<div id=\"modal-popup\" class=\"modal-popup\">
\t\t\t<div class=\"modal-overlay\"></div>
\t\t\t<div class=\"modal-fix\">
\t\t\t\t<div class=\"modal-container\">
\t\t\t\t\t<div class=\"modal-bg modal-bg2\">
\t\t\t\t\t\t<div class=\"context-loader\">Please wait</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div id=\"header\">
\t\t\t<div class=\"header_container\">
\t\t\t\t<div class=\"yui3-g\">
\t\t\t\t\t<div class=\"yui3-u-3-4\">
\t\t\t\t\t\t<div style=\"padding-top:0;text-align:right\">
\t\t\t\t\t\t\t";
        // line 83
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($_app_, "user")) {
            // line 84
            echo "\t\t\t\t\t\t\t\t<div class=\"right\">
\t\t\t\t\t\t\t\t\t<div style=\"text-align:left;padding-top:0px;\">
\t\t\t\t\t\t\t\t\t\t<a href=\"";
            // line 86
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyMoney", ), "method"), "html", null, true);
            echo "\" style=\"text-decoration:none;margin-right:20px;\"><img src=\"/images/wallet.png\" width=\"20\"  /><span style=\"font-weight: bold;color:#DDD;font-size:16px;\">My Money:</span> <span style=\"font-weight: bold;color:#fff;font-size:16px;\">";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($_app_, "user"), "wallet")), "html", null, true);
            echo "</span></a>
\t\t\t\t\t\t\t\t\t\t<br />
\t\t\t\t\t\t\t\t\t\t<a href=\"";
            // line 88
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyWMWCredits", ), "method"), "html", null, true);
            echo "\" style=\"text-decoration:none;margin-right:20px;\"><img src=\"/images/logo_final.png\" width=\"20\"  /><span style=\"font-weight: bold;color:#DDD;font-size:16px;\">WMW Credits:</span> <span style=\"font-weight: bold;color:#fff;font-size:16px;\">";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($_app_, "user"), "virtual_wallet")), "html", null, true);
            echo "</span></a>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        }
        // line 92
        echo "\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"logo\"><a href=\"/\">WinMaWeb</a></div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"yui3-u-1-4\">
\t\t\t\t\t\t<div class=\"header_login\">
\t\t\t\t\t\t\t";
        // line 97
        $this->displayBlock('header_info', $context, $blocks);
        // line 117
        echo "\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
        // line 118
        $this->displayBlock('main_menu', $context, $blocks);
        // line 130
        echo "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div id=\"content\">
\t\t\t<div class=\"content_container\">
\t\t\t\t";
        // line 136
        $this->displayBlock('slider', $context, $blocks);
        // line 137
        echo "\t\t\t\t<div class=\"content_page\">
\t\t\t\t\t<div class=\"container_page\">
\t\t\t\t\t\t<div class=\"yui3-g\">
\t\t\t\t\t\t\t<div class=\"yui3-u-17-24\">
\t\t\t\t\t\t\t\t<div id=\"ajax-content\">";
        // line 141
        $this->displayBlock('content_page_register', $context, $blocks);
        echo "</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"yui3-u-7-24\">
\t\t\t\t\t\t\t\t<div class=\"right_side\">
\t\t\t\t\t\t\t\t\t";
        // line 145
        $this->displayBlock('right_side', $context, $blocks);
        // line 147
        echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"box_shadow\"></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div id=\"footer\">
\t\t\t<div class=\"footer_container\">
\t\t\t\t";
        // line 157
        $this->displayBlock('footer', $context, $blocks);
        // line 188
        echo "\t\t\t</div>
\t\t</div>
\t</body>
</html>";
    }

    // line 4
    public function block_page_title($context, array $blocks = array())
    {
        echo "WinMaWeb";
    }

    // line 9
    public function block_seo($context, array $blocks = array())
    {
        // line 10
        echo "\t\t<meta name=\"description\" content=\"WinMaWeb\" />
\t\t<meta name=\"keywords\" content=\"WinMaWeb\" />
\t\t";
    }

    // line 15
    public function block_css($context, array $blocks = array())
    {
        // line 16
        echo "\t\t";
    }

    // line 66
    public function block_js($context, array $blocks = array())
    {
        // line 67
        echo "\t\t";
    }

    // line 97
    public function block_header_info($context, array $blocks = array())
    {
        // line 98
        echo "\t\t\t\t\t\t\t\t";
        if (isset($context["userGroup"])) { $_userGroup_ = $context["userGroup"]; } else { $_userGroup_ = null; }
        if ($_userGroup_) {
            // line 99
            echo "\t\t\t\t\t\t\t\t\t<div style=\"float:left; margin: auto; width: 200px;\"><img src=\"/images/site/";
            if (isset($context["userGroup"])) { $_userGroup_ = $context["userGroup"]; } else { $_userGroup_ = null; }
            echo twig_escape_filter($this->env, $_userGroup_, "html", null, true);
            echo "-badge-small.png\" /></div>
\t\t\t\t\t\t\t\t";
        }
        // line 101
        echo "\t\t\t\t\t\t\t\t<div style=\"float: right;\">
\t\t\t\t\t\t\t\t\t";
        // line 102
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($_app_, "user")) {
            // line 103
            echo "\t\t\t\t\t\t\t\t\t\tWelcome ";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "user"), "first_name"), "html", null, true);
            echo " ";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "user"), "last_name"), "html", null, true);
            echo " ";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            if (($this->getAttribute($this->getAttribute($_app_, "user"), "is_do") == 1)) {
                echo "<span class=\"label2 label-info\">Merchant</span>";
            }
            echo " ";
            if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
            if ($this->getAttribute($_userObj_, "hasRole", array("AGENT", ), "method")) {
                echo " <span class=\"label2 label-info\" style=\"background-color: #888;\">Agent</span>";
            }
            echo ",
\t\t\t\t\t\t\t\t\t\t<br />
\t\t\t\t\t\t\t\t\t\t<a href=\"/my-account\" style=\"font-weight: bold;\">My Account</a>
\t\t\t\t\t\t\t\t\t\t";
            // line 106
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            if ($this->getAttribute($this->getAttribute($_app_, "shopCart"), "products")) {
                // line 107
                echo "\t\t\t\t\t\t\t\t\t\t\t| 
\t\t\t\t\t\t\t\t\t\t\t<a href=\"";
                // line 108
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@paymentShopCart", ), "method"), "html", null, true);
                echo "\"><img src=\"/images/site/shopping_cart_green.png\" width=\"15\" height=\"15\" alt=\"\" />Shopping Cart</a>
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 110
            echo "\t\t\t\t\t\t\t\t\t\t| 
\t\t\t\t\t\t\t\t\t\t<a href=\"/logout\">Logout</a>
\t\t\t\t\t\t\t\t\t";
        } else {
            // line 113
            echo "\t\t\t\t\t\t\t\t\t\t<a href=\"/request-membership\" id=\"request-membership\" title=\"Request Membership\">Request Membership</a> | <a href=\"/login\" id=\"login-register\" title=\"Login\">Login</a>
\t\t\t\t\t\t\t\t\t";
        }
        // line 115
        echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
    }

    // line 118
    public function block_main_menu($context, array $blocks = array())
    {
        // line 119
        echo "\t\t\t\t\t\t\t<div class=\"main_menu_container\">
\t\t\t\t\t\t\t\t<ul class=\"main_menu\">
\t\t\t\t\t\t\t\t\t<li><a href=\"/\">Today's Deal</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"/all-deals\">All Deals</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"/recent-deals\">Recent Deals</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"/charities\">Charities</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"/how-its-working\" class=\"white-button\">How Does It Work?</a></li>
\t\t\t\t\t\t\t\t\t";
        // line 126
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($this->getAttribute($_app_, "shopCart"), "product_id")) {
            echo "<li class=\"h_basket\"><a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@paymentShopCart", ), "method"), "html", null, true);
            echo "\" class=\"basket\">Shopcart</a></li>";
        }
        // line 127
        echo "\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
    }

    // line 136
    public function block_slider($context, array $blocks = array())
    {
    }

    // line 141
    public function block_content_page_register($context, array $blocks = array())
    {
    }

    // line 145
    public function block_right_side($context, array $blocks = array())
    {
        // line 146
        echo "\t\t\t\t\t\t\t\t\t";
    }

    // line 157
    public function block_footer($context, array $blocks = array())
    {
        // line 158
        echo "\t\t\t\t\t<div class=\"yui3-g\">
\t\t\t\t\t\t<div class=\"yui3-u-1-3\">
\t\t\t\t\t\t\t<div class=\"fpad_box\">
\t\t\t\t\t\t\t\t<h3>Learn More</h3>
\t\t\t\t\t\t\t\t<div class=\"footer_box\">
\t\t\t\t\t\t\t\t\t<ul class=\"footer_menu\">
\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 164
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@pages?slug=faq", ), "method"), "html", null, true);
        echo "\">FAQ</a></li>
\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 165
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@pages?slug=how-its-working", ), "method"), "html", null, true);
        echo "\">How Does It Work?</a></li>
\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 166
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@pages?slug=about-us", ), "method"), "html", null, true);
        echo "\">About Us</a></li>
\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 167
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@pages?slug=terms-and-conditions", ), "method"), "html", null, true);
        echo "\">Terms And Conditions</a></li>
\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 168
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@pages?slug=contact-us", ), "method"), "html", null, true);
        echo "\">Contact Us</a></li>
\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"fpad_box\">
\t\t\t\t\t\t\t\t\t<a href=\"https://www.facebook.com/pages/WinMaWeb/335729719827287\"><img src=\"/images/site/social_14.png\" width=\"25\" height=\"25\" /></a>
\t\t\t\t\t\t\t\t\t<a href=\"https://twitter.com/#!/winmaweb\"><img src=\"/images/site/social_16.png\" width=\"25\" height=\"25\" /></a>
\t\t\t\t\t\t\t\t\t<a href=\"";
        // line 174
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@pages?slug=contact-us", ), "method"), "html", null, true);
        echo "\"><img src=\"/images/site/social_18.png\" width=\"25\" height=\"25\" /></a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>  
\t\t\t\t\t\t<div class=\"yui3-u-1-2\">
\t\t\t\t\t\t\t<h3>About Us</h3>
\t\t\t\t\t\t\t<div class=\"footer_box\">
\t\t\t\t\t\t\t\tWinMaWeb is a social network dedicated to redistributing wealth back to the people.  Members join to benefit from great savings on local deals and may earn an income.  Businesses join WinMaWeb to save on marketing and advertising costs and to increase their customer base.  Members can become Agents by contacting local businesses and placing their deals on WinMaWeb.
\t\t\t\t\t\t\t\t<br /><br />
\t\t\t\t\t\t\t\tMembers can take advantage of the savings, and they may choose to earn an extra income by developing their Network to the 5th Tier.  In addition, you can earn even more income by bringing in local businesses.  Either way, its always free, so you win.    
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
    }

    public function getTemplateName()
    {
        return "layouts/layout_register.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
