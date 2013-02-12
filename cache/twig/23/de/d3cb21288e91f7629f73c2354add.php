<?php

/* index.twig */
class __TwigTemplate_23ded3cb21288e91f7629f73c2354add extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
            'seo' => array($this, 'block_seo'),
            'js' => array($this, 'block_js'),
            'css' => array($this, 'block_css'),
            'main_menu' => array($this, 'block_main_menu'),
            'content_page' => array($this, 'block_content_page'),
            'right_side' => array($this, 'block_right_side'),
            'quote' => array($this, 'block_quote'),
            'side_dw' => array($this, 'block_side_dw'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getAttribute($this->getContext($context, "app"), "ajax")) ? ("layouts/ajax.twig") : ("layouts/layout_index.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_page_title($context, array $blocks = array())
    {
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "name"), "html", null, true);
        echo " :: DailyDeals";
    }

    // line 4
    public function block_seo($context, array $blocks = array())
    {
        // line 5
        echo "    <meta name=\"description\" content=\"";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "name"), "html", null, true);
        echo " price ";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "price"), "html", null, true);
        echo "\$ ,";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "short_description"), "html", null, true);
        echo "\" />
    <meta name=\"keywords\" content=\"";
        // line 6
        ob_start();
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_product_, "ProductTags"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_tag_, "Tag"), "name"), "html", null, true);
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "last")) {
            } else {
                echo ",";
            }
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo ",price ";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "price"), "html", null, true);
        echo "\$,discount ";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "discount"), "html", null, true);
        echo "%,you save ";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "money_save"), "html", null, true);
        echo "\$";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        echo "\" />
    ";
    }

    // line 8
    public function block_js($context, array $blocks = array())
    {
        // line 9
        echo "    <script type=\"text/javascript\" src=\"/js/jquery.countdown.min.js\"></script>
    <script type=\"text/javascript\" src=\"/js/jquery-ui-1.8.16.custom.min.js\"></script>
    <script type=\"text/javascript\" src=\"/js/slides.min.jquery.js\"></script>
    <script type=\"text/javascript\" src=\"/js/jquery.prettyPhoto.js\"></script>
    <script type=\"text/javascript\" src=\"/js/product.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/function.js\"></script>
    <script type=\"text/javascript\">
    function initialize() {
          var latLng = new google.maps.LatLng(1.2940447772307804, 103.830810546875);;
          var mlatLng = ";
        // line 18
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if ((($this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "latitude") != 0) || ($this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "longitude") != 0))) {
            echo "new google.maps.LatLng(";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "latitude"), "html", null, true);
            echo ", ";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "longitude"), "html", null, true);
            echo ")";
        } else {
            echo "latLng";
        }
        echo ";

          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: mlatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          });
          var marker = new google.maps.Marker({
            position: mlatLng,
            ";
        // line 27
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if ((($this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "latitude") != 0) || ($this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "longitude") != 0))) {
            // line 28
            echo "            map:map,            
            ";
        }
        // line 30
        echo "            draggable: false
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
        // line 43
        if (isset($context["ajax"])) { $_ajax_ = $context["ajax"]; } else { $_ajax_ = null; }
        if ((!$_ajax_)) {
            // line 44
            echo "        window.onload = loadScript;
    //google.maps.event.addDomListener(window, 'load', initialize);
    ";
        } else {
            // line 47
            echo "        \$(function() {
            loadScript();
            //initialize();
        });
    ";
        }
        // line 52
        echo "\t\tjQuery(document).ready(function(){
\t\tcheckCookie();
\t\t});
\t\tfunction getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(\";\");
for (i=0;i<ARRcookies.length;i++)
  {
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf(\"=\"));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf(\"=\")+1);
  x=x.replace(/^\\s+|\\s+\$/g,\"\");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}

function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? \"\" : \"; expires=\"+exdate.toUTCString());
document.cookie=c_name + \"=\" + c_value;
}

function checkCookie()
{
var username=getCookie(\"username\");
if (username!=null && username!=\"\")
  {
  //alert(\"Welcome again \" + username);
  }
else 
  {
  //username=prompt(\"Please enter your name:\",\"\");
\tvar username = 'video_click';
  if (username!=null && username!=\"\")
    {
\t\t\t\$('#video_click').click();
    setCookie(\"username\",username,365);
    }
  }
}

</script>
";
    }

    // line 99
    public function block_css($context, array $blocks = array())
    {
        // line 100
        echo "    <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/ui-lightness/jquery-ui-1.8.16.custom.css\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/prettyPhoto.css\" />
";
    }

    // line 104
    public function block_main_menu($context, array $blocks = array())
    {
        // line 105
        echo "<div class=\"main_menu_container\">
\t<ul class=\"main_menu\">
\t\t\t<li><a href=\"/\" class=\"active\">Today's Deal</a></li>
\t\t\t<li><a href=\"/all-deals\">All Deals</a></li>
\t\t\t<li><a href=\"/recent-deals\">Recent Deals</a></li>
                        <li><a href=\"/charities\">Charities</a></li>
\t\t\t<li><a href=\"/how-its-working\" class=\"white-button\">How Does It Work?</a></li>
\t\t\t";
        // line 112
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($this->getAttribute($_app_, "shopCart"), "product_id")) {
            echo "<li class=\"h_basket\"><a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@paymentShopCart", ), "method"), "html", null, true);
            echo "\" class=\"basket\">Shopcart</a></li>";
        }
        // line 113
        echo "\t</ul>
</div>
";
    }

    // line 116
    public function block_content_page($context, array $blocks = array())
    {
        // line 117
        echo "\t\t<div class=\"p-container\">
\t\t\t";
        // line 118
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if ($_product_) {
            // line 119
            echo "\t\t\t<h1>";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "name"), "html", null, true);
            echo "</h1>
\t\t\t<div class=\"p-shortdesc\">";
            // line 120
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "short_description"), "html", null, true);
            echo "</div>
\t\t\t<div class=\"yui3-g\">
\t\t\t\t\t<div class=\"yui3-u-3-5\">
\t\t\t\t\t\t\t<div class=\"p-top_left\">
\t\t\t\t\t\t\t\t<div id=\"slides_container\" >
\t\t\t\t\t\t\t\t\t<div id=\"slides\">
\t\t\t\t\t\t\t\t\t\t<div class=\"slides_container\">
\t\t\t\t\t\t\t\t\t\t";
            // line 127
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_product_, "ProductMedia"));
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 128
                echo "\t\t\t\t\t\t\t\t\t\t\t<a href=\"";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "dir"), "html", null, true);
                echo "/";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "file_name"), "html", null, true);
                echo "_";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "id"), "html", null, true);
                echo ".";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "ext"), "html", null, true);
                echo "\" rel=\"prettyPhoto[]\" title=\"\"><img src=\"";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "dir"), "html", null, true);
                echo "/thumb380x237/";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "file_name"), "html", null, true);
                echo "_";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "id"), "html", null, true);
                echo ".";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "ext"), "html", null, true);
                echo "\" width=\"610\" height=\"290\" /></a>
\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 130
            echo "\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<br />
\t\t\t\t\t\t\t<!-- AddThis Button BEGIN -->
\t\t\t\t\t\t\t<div class=\"addthis_toolbox addthis_default_style \">
\t\t\t\t\t\t\t<a class=\"addthis_button_facebook_like\" fb:like:layout=\"button_count\"></a>
\t\t\t\t\t\t\t<a class=\"addthis_button_tweet\"></a>
\t\t\t\t\t\t\t<a class=\"addthis_button_google_plusone\" g:plusone:size=\"medium\"></a>
\t\t\t\t\t\t\t<a class=\"addthis_counter addthis_pill_style\"></a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<script type=\"text/javascript\" src=\"https://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ec2a51b78f841f4\"></script>
\t\t\t\t\t\t\t<!-- AddThis Button END -->
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<ul class=\"nav nav-tabs\">
\t\t\t\t\t\t\t\t\t<li ";
            // line 145
            if (isset($context["tab"])) { $_tab_ = $context["tab"]; } else { $_tab_ = null; }
            if (($_tab_ == "")) {
                echo "class=\"active\"";
            }
            echo ">
\t\t\t\t\t\t\t\t\t\t\t<a href=\"/";
            // line 146
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
            echo "/";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
            echo ".html\">Description</a>
\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t";
            // line 151
            echo "\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t<div class=\"descr_raw\">";
            // line 153
            if (isset($context["bbcode"])) { $_bbcode_ = $context["bbcode"]; } else { $_bbcode_ = null; }
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo $this->getAttribute($_bbcode_, "p", array($this->getAttribute($_product_, "description"), 1, ), "method");
            echo "</div>
\t\t\t\t\t\t\t\t<div class=\"p-terms\">";
            // line 154
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_nl2br_filter(twig_escape_filter($this->env, $this->getAttribute($_product_, "terms"), "html", null, true));
            echo "</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t</div>
\t\t\t";
        }
        // line 159
        echo "    </div>
<br /><br />

";
        // line 162
        if (isset($context["similar"])) { $_similar_ = $context["similar"]; } else { $_similar_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_similar_);
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 163
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "first")) {
                // line 164
                echo "<ul class=\"products_list\">
    <li><h3 class=\"cssfonts--26\">Similar offers</h3></li>
";
            }
            // line 167
            echo "    ";
            $this->env->loadTemplate("inc/productList.twig")->display($context);
            // line 168
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "last")) {
                echo "</ul>";
            }
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
    }

    // line 172
    public function block_right_side($context, array $blocks = array())
    {
        // line 173
        echo "\t<div class=\"yui3-u-3-5\">
\t\t<div class=\"p-top\">
\t\t\t";
        // line 175
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if ($_product_) {
            // line 176
            echo "\t\t\t\t<div class=\"prod-timer clearfix\" style=\"padding:5px;\">
\t\t\t\t\t<div class=\"center strong cssfonts--20\" style=\"color: #7E7E7E\">Deal Ends In</div>
\t\t\t\t\t";
            // line 179
            echo "\t\t\t\t\t<div class=\"p_timer_content\"><span>";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_product_, "endtime"), "Y/m/d H:i"), "html", null, true);
            echo "</span><span>";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_product_, "starttime"), "Y/m/d H:i"), "html", null, true);
            echo "</span></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"discount\">
\t\t\t\t\t<span>Discount</span> 
\t\t\t\t\t<h5>";
            // line 183
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "discount"), "html", null, true);
            echo "%</h5>
\t\t\t\t</div>
\t\t\t\t<div class=\"product-content\">
\t\t\t\t\t<div class=\"blog-right-dwo\"><span>Value</span> <p>";
            // line 186
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "suplier_price")), "html", null, true);
            echo "</p></div>
\t\t\t\t\t<div class=\"blog-right-dwo\"><span>Price</span> <p>";
            // line 187
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "price")), "html", null, true);
            echo "</p></div>
\t\t\t\t\t<div class=\"clearfix\"></div>
\t\t\t\t</div>
\t\t\t\t";
            // line 190
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") == $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock"))) {
                // line 191
                echo "\t\t\t\t\t<div class=\"blog-right-button\">
\t\t\t\t\t\t";
                // line 193
                echo "\t\t\t\t\t\t\t<div class=\"button_buy\">
\t\t\t\t\t\t\t\t<div class=\"blog-right-grey-left\"></div>
\t\t\t\t\t\t\t\t<div class=\"blog-right-grey-center\">Buy</div>
\t\t\t\t\t\t\t\t<div class=\"blog-right-grey-right\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
                // line 199
                echo "\t\t\t\t\t</div>
\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t<div style=\"margin: 0px 25px;padding-top:2px;\"><img src=\"/images/site/gift_grey.png\" width=\"59\" height=\"60\" /><div style=\"cursor: default; line-height:60px;display:block;color:#cccccc;font-weight:bold;font-size: 16px;text-decoration: none;padding-right:5px;\" class=\"right\">Buy For A Friend</div></div>
\t\t\t\t";
            } else {
                // line 203
                echo "\t\t\t\t\t<div class=\"blog-right-button\">
\t\t\t\t\t\t<a href=\"";
                // line 204
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((((("@productProfile?user_slug=" . $this->getAttribute($this->getAttribute($_product_, "User"), "username")) . "&product_slug=") . $this->getAttribute($_product_, "slug")) . "&options=true"), ), "method"), "html", null, true);
                echo "\" class=\"modal-pp\">
\t\t\t\t\t\t\t<div class=\"button_buy\">
\t\t\t\t\t\t\t\t<div class=\"blog-right-left\"></div>
\t\t\t\t\t\t\t\t<div class=\"blog-right-center\">Buy</div>
\t\t\t\t\t\t\t\t<div class=\"blog-right-right\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t<div style=\"margin: 0px 25px;padding-top:2px;\"><a href=\"";
                // line 213
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((((("@productProfile?user_slug=" . $this->getAttribute($this->getAttribute($_product_, "User"), "username")) . "&product_slug=") . $this->getAttribute($_product_, "slug")) . "&options=true&friend=1"), ), "method"), "html", null, true);
                echo "\" class=\"modal-pp\"><img src=\"/images/site/gift.png\" width=\"59\" height=\"60\" /></a><a style=\"line-height:60px;display:block;color:#368592;font-weight:bold;font-size: 16px;text-decoration: none;padding-right:5px;\" href=\"";
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((((("@productProfile?user_slug=" . $this->getAttribute($this->getAttribute($_product_, "User"), "username")) . "&product_slug=") . $this->getAttribute($_product_, "slug")) . "&options=true&friend=1"), ), "method"), "html", null, true);
                echo "\" class=\"right modal-pp\">Buy For A Friend</a></div>
\t\t\t\t";
            }
            // line 215
            echo "\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t<div class=\"prod-box-content\">
\t\t\t\t\t";
            // line 217
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "sold") >= 0)) {
                echo "<div style=\"padding-top:5px;text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_product_, "sold"), "html", null, true);
                echo " Offer(s) Bought</div>";
            }
            // line 218
            echo "\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "sold") >= $this->getAttribute($_product_, "min_sold"))) {
                // line 219
                echo "\t\t\t\t\t\t";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                $context["percent"] = intval(floor((($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") * 100) / $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock"))));
                // line 220
                echo "\t\t\t\t\t\t";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                if (((($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") * 100) % $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock")) >= 5)) {
                    // line 221
                    echo "\t\t\t\t\t\t";
                    if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                    $context["percent"] = ($_percent_ + 1);
                    // line 222
                    echo "\t\t\t\t\t\t";
                }
                // line 223
                echo "\t\t\t\t\t\t<div style=\"width: 200px;\">
\t\t\t\t\t\t\t<div id=\"progress1\" class=\"progress\">
\t\t\t\t\t\t\t\t<span style=\"width: ";
                // line 225
                if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                echo twig_escape_filter($this->env, $_percent_, "html", null, true);
                echo "%;\">
\t\t\t\t\t\t\t\t\t<b>";
                // line 226
                if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                echo twig_escape_filter($this->env, $_percent_, "html", null, true);
                echo "%</b>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
                // line 230
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                if (($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") == $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock"))) {
                    // line 231
                    echo "\t\t\t\t\t\t\t<div style=\"padding-top:5px;text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">Sorry, but that deal offer is already sold out.</div>
\t\t\t\t\t\t";
                } else {
                    // line 233
                    echo "\t\t\t\t\t\t\t<div style=\"padding-top:5px;text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">Deal is active</div>
\t\t\t\t\t\t";
                }
                // line 235
                echo "\t\t\t\t\t";
            } else {
                // line 236
                echo "\t\t\t\t\t\t";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                $context["percent"] = intval(floor((($this->getAttribute($_product_, "sold") * 100) / $this->getAttribute($_product_, "min_sold"))));
                // line 237
                echo "\t\t\t\t\t\t";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                if (((($this->getAttribute($_product_, "sold") * 100) % $this->getAttribute($_product_, "min_sold")) >= 5)) {
                    // line 238
                    echo "\t\t\t\t\t\t\t";
                    if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                    $context["percent"] = ($_percent_ + 1);
                    // line 239
                    echo "\t\t\t\t\t\t";
                }
                // line 240
                echo "\t\t\t\t\t\t";
                // line 241
                echo "\t\t\t\t\t\t<div style=\"width: 200px;\">
\t\t\t\t\t\t\t<div id=\"progress1\" class=\"progress\">
\t\t\t\t\t\t\t\t<span style=\"width: ";
                // line 243
                if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                echo twig_escape_filter($this->env, $_percent_, "html", null, true);
                echo "%;\">
\t\t\t\t\t\t\t\t\t<b>";
                // line 244
                if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                echo twig_escape_filter($this->env, $_percent_, "html", null, true);
                echo "%</b>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div style=\"padding-top:5px; width: 230px; margin-left: -15px; text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">";
                // line 248
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, ($this->getAttribute($_product_, "min_sold") - $this->getAttribute($_product_, "sold")), "html", null, true);
                echo " more and the Deal is ON!</div>
\t\t\t\t\t";
            }
            // line 250
            echo "\t\t\t\t</div>
\t\t\t";
        }
        // line 252
        echo "\t\t\t";
        // line 257
        echo "\t\t</div>
\t\t<div class=\"p-tags\">
\t\t\t";
        // line 259
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_product_, "ProductTags"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 260
            echo "\t\t\t\t";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "first")) {
                echo "<h3>Tags</h3>";
            }
            // line 261
            echo "\t\t\t\t";
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_tag_, "Tag"), "name"), "html", null, true);
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "last")) {
            } else {
                echo ",";
            }
            // line 262
            echo "\t\t\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 263
        echo "\t\t</div>
\t\t<div style=\"padding-top:10px;padding-left:20px;\">
\t\t\t<div style=\"font-weight:bold;font-size: 16px;\">Deal's Location</div>
\t\t\t<div id=\"map\" align=\"center\" style=\"width: 210px; height: 200px;margin-top:15px; position: relative;overflow: hidden;padding-left:20px;\"></div>
\t\t\t<div>Please use the zoom functions to find the deal location.</div>
\t\t\t<div style=\"padding-top:10px;\">
\t\t\t\t";
        // line 269
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "address"), "html", null, true);
        echo ", ";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "county"), "html", null, true);
        echo ", ";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "city"), "html", null, true);
        echo ", ";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "postcode"), "html", null, true);
        echo "<br />
\t\t\t\t";
        // line 270
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "phone"), "html", null, true);
        echo "
\t\t\t</div>
\t\t</div>
\t</div>
    
    ";
    }

    // line 307
    public function block_quote($context, array $blocks = array())
    {
        // line 308
        echo "
<div class=\"content_page\">
    <div class=\"container_page clearfix\" style=\"height:350px;\">
        <div class=\"left\" style=\"width:610px;\">
        ";
        // line 312
        if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
        if ($_charity_) {
            // line 313
            echo "        <div class=\"title-blog-small\"><a href=\"/charity/";
            if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_charity_, "slug"), "html", null, true);
            echo ".html\">";
            if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_charity_, "name"), "html", null, true);
            echo "</a></div>
        <div style=\"width:610px;height:300px;\"><a href=\"/charity/";
            // line 314
            if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_charity_, "slug"), "html", null, true);
            echo ".html\" class=\"pirobox \" title=\"\" rel=\"single\"><img src=\"";
            if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_charity_, "CharityMedia"), 0), "dir"), "html", null, true);
            echo "/";
            if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_charity_, "CharityMedia"), 0), "file_name"), "html", null, true);
            echo "_";
            if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_charity_, "CharityMedia"), 0), "id"), "html", null, true);
            echo ".";
            if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_charity_, "CharityMedia"), 0), "ext"), "html", null, true);
            echo "\" width=\"610\" height=\"300\" style=\"border:2px solid #fff;padding:1px;\" /></a></div>
        ";
        }
        // line 316
        echo "        </div>
        <div class=\"right\" style=\"border-left:1px solid #cacaca;padding-left:10px;height:350px;\">
            <a href=\"/contact-us\" title=\"\" ><img src=\"/images/happy.png\" /></a>
            <div style=\"width:250px;\">WMW cares about your feedback and satisfaction.Let us know what you think!:-)</div>
        </div>
        <br /><br />
    </div>
</div>
<br /><br />

\t<p>\"It's not like a job, It's more like a hobby, we call it JOBBY\"</p>
\t<div class=\"small-button-h\">
\t\t<div class=\"name_left\">Danish Miqhael - </div>
\t\t<a href=\"https://www.youtube.com/watch?v=pMCPHVjKQdE\" rel=\"prettyPhoto\" class=\"right\" title=\"\" id=\"video_click\">
\t\t\t<div class=\"button_see\">
\t\t\t\t<div class=\"small-left\"></div>
\t\t\t\t<div class=\"small-center\">See how it works</div>
\t\t\t\t<div class=\"small-right\"></div>
\t\t\t</div>
\t\t</a><!--/button-->
\t</div>
\t<div style=\"clear: both;\"></div>
";
    }

    // line 341
    public function block_side_dw($context, array $blocks = array())
    {
        // line 342
        if (isset($context["index_products"])) { $_index_products_ = $context["index_products"]; } else { $_index_products_ = null; }
        if ($_index_products_) {
            // line 343
            echo "<div class=\"container_page\">
\t";
            // line 344
            $context["i"] = 0;
            // line 345
            echo "\t";
            if (isset($context["index_products"])) { $_index_products_ = $context["index_products"]; } else { $_index_products_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_index_products_);
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 346
                echo "\t\t";
                if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                $context["i"] = ($_i_ + 1);
                // line 347
                echo "\t\t";
                $this->env->loadTemplate("inc/productList.twig")->display($context);
                // line 348
                echo "\t\t";
                if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                if ((($_i_ % 3) != 0)) {
                    // line 349
                    echo "\t\t<div class=\"border-vertical\"></div>
\t\t";
                }
                // line 351
                echo "\t";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 352
            echo "\t";
            // line 561
            echo "<div style=\"clear: both;\"></div>
</div>
";
        }
        // line 564
        echo "
<div class=\"container_page\" style=\"margin-top: 30px;\">
\t<div class=\"user_group\">
\t\t<div><img src=\"/images/site/gold.png\" /></div>
\t\t";
        // line 568
        if (isset($context["goldusers"])) { $_goldusers_ = $context["goldusers"]; } else { $_goldusers_ = null; }
        if ($_goldusers_) {
            // line 569
            echo "\t\t\t";
            if (isset($context["goldusers"])) { $_goldusers_ = $context["goldusers"]; } else { $_goldusers_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_goldusers_);
            foreach ($context['_seq'] as $context["_key"] => $context["golduser"]) {
                // line 570
                echo "\t\t\t<br/><a href=\"/profile/";
                if (isset($context["golduser"])) { $_golduser_ = $context["golduser"]; } else { $_golduser_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_golduser_, "username"), "html", null, true);
                echo "\">";
                if (isset($context["golduser"])) { $_golduser_ = $context["golduser"]; } else { $_golduser_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_golduser_, "username"), "html", null, true);
                echo "</a>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['golduser'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 572
            echo "\t\t";
        }
        // line 573
        echo "\t</div>
\t<div class=\"user_group\">
\t\t<div><img src=\"/images/site/silver.png\" /></div>
\t\t";
        // line 576
        if (isset($context["silverusers"])) { $_silverusers_ = $context["silverusers"]; } else { $_silverusers_ = null; }
        if ($_silverusers_) {
            // line 577
            echo "\t\t\t";
            if (isset($context["silverusers"])) { $_silverusers_ = $context["silverusers"]; } else { $_silverusers_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_silverusers_);
            foreach ($context['_seq'] as $context["_key"] => $context["silveruser"]) {
                // line 578
                echo "\t\t\t<br/><a href=\"/profile/";
                if (isset($context["silveruser"])) { $_silveruser_ = $context["silveruser"]; } else { $_silveruser_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_silveruser_, "username"), "html", null, true);
                echo "\">";
                if (isset($context["silveruser"])) { $_silveruser_ = $context["silveruser"]; } else { $_silveruser_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_silveruser_, "username"), "html", null, true);
                echo "</a>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['silveruser'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 580
            echo "\t\t";
        }
        // line 581
        echo "\t</div>
\t<div class=\"user_group\">
\t\t<div><img src=\"/images/site/bronze.png\" /></div>
\t\t";
        // line 584
        if (isset($context["bronzeusers"])) { $_bronzeusers_ = $context["bronzeusers"]; } else { $_bronzeusers_ = null; }
        if ($_bronzeusers_) {
            // line 585
            echo "\t\t\t";
            if (isset($context["bronzeusers"])) { $_bronzeusers_ = $context["bronzeusers"]; } else { $_bronzeusers_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_bronzeusers_);
            foreach ($context['_seq'] as $context["_key"] => $context["bronzeuser"]) {
                // line 586
                echo "\t\t\t<br/><a href=\"/profile/";
                if (isset($context["bronzeuser"])) { $_bronzeuser_ = $context["bronzeuser"]; } else { $_bronzeuser_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_bronzeuser_, "username"), "html", null, true);
                echo "\">";
                if (isset($context["bronzeuser"])) { $_bronzeuser_ = $context["bronzeuser"]; } else { $_bronzeuser_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_bronzeuser_, "username"), "html", null, true);
                echo "</a>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bronzeuser'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 588
            echo "\t\t";
        }
        // line 589
        echo "\t</div>
\t<div style=\"clear: both;\"></div>
</div>
";
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
