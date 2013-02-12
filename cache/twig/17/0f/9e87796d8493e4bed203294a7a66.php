<?php

/* product.twig */
class __TwigTemplate_170f9e87796d8493e4bed203294a7a66 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
            'seo' => array($this, 'block_seo'),
            'js' => array($this, 'block_js'),
            'css' => array($this, 'block_css'),
            'content_page' => array($this, 'block_content_page'),
            'right_side' => array($this, 'block_right_side'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getAttribute($this->getContext($context, "app"), "ajax")) ? ("layouts/ajax.twig") : ("layouts/layout_product.twig")));
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
    
\t\t<script type=\"text/javascript\">
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
        // line 19
        echo "
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
        echo "</script>
";
    }

    // line 54
    public function block_css($context, array $blocks = array())
    {
        // line 55
        echo "    <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/ui-lightness/jquery-ui-1.8.16.custom.css\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/prettyPhoto.css\" />
";
    }

    // line 58
    public function block_content_page($context, array $blocks = array())
    {
        // line 59
        echo "    <div class=\"p-container\">
\t\t\t";
        // line 60
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((($this->getAttribute($_product_, "status") == 2) && ($this->getAttribute($_product_, "merchant_user_id") == $this->getAttribute($this->getAttribute($_app_, "user"), "id")))) {
            // line 61
            echo "\t\t\t\t<form action=\"/";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
            echo "/";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
            echo ".html\" method=\"post\">
\t\t\t\t\t<input type=\"hidden\" name=\"confirm_product\" value=\"1\" />
\t\t\t\t\t<span style=\"font-size: 18px;\">This product is not confirmed. <input type=\"submit\" id=\"confirm_now\" value=\"Confirm now\" /></span>
\t\t\t\t</form>
\t\t\t";
        }
        // line 66
        echo "        <h1>";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "name"), "html", null, true);
        echo "</h1>
        <div class=\"p-shortdesc\">";
        // line 67
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "short_description"), "html", null, true);
        echo "</div>
        <div class=\"yui3-g\">
            <div class=\"yui3-u-3-5\">
                <div class=\"p-top_left\">
                    <div id=\"slides_container\">
\t\t\t\t\t\t\t\t\t\t\t<div id=\"slides\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"slides_container\">
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 74
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_product_, "ProductMedia"));
        foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
            // line 75
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a href=\"";
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
            echo "/thumb610x290/";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "file_name"), "html", null, true);
            echo "_";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "id"), "html", null, true);
            echo ".";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "ext"), "html", null, true);
            echo "\" width=\"610\" height=\"290\" /></a>
\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 77
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
                    </div>
                <br />
                <!-- AddThis Button BEGIN -->
                <div class=\"addthis_toolbox addthis_default_style \">
                <a class=\"addthis_button_facebook_like\" fb:like:layout=\"button_count\"></a>
                <a class=\"addthis_button_tweet\"></a>
                <a class=\"addthis_button_google_plusone\" g:plusone:size=\"medium\"></a>
                <a class=\"addthis_counter addthis_pill_style\"></a>
                </div>
                <script type=\"text/javascript\" src=\"https://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ec2a51b78f841f4\"></script>
                <!-- AddThis Button END -->
                </div>
                <ul class=\"nav nav-tabs\">
                    <li ";
        // line 92
        if (isset($context["tab"])) { $_tab_ = $context["tab"]; } else { $_tab_ = null; }
        if (($_tab_ == "")) {
            echo "class=\"active\"";
        }
        echo ">
                        <a href=\"/";
        // line 93
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
        echo "/";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
        echo ".html\">Description</a>
                    </li>
                    ";
        // line 98
        echo "\t\t\t\t\t\t\t\t\t\t<li style=\"float: right; padding-top: 8px;\">Offered by:<a href=\"/profile/";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
        echo "\" style=\"color:#2F5BB7;text-decoration:none; padding: 0px; display: inline;\">";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
        echo "</a></li>
                </ul>
\t\t\t\t\t\t\t\t<div>
                ";
        // line 101
        if (isset($context["tab"])) { $_tab_ = $context["tab"]; } else { $_tab_ = null; }
        if (($_tab_ == "")) {
            // line 102
            echo "                    ";
            // line 103
            echo "\t\t\t\t\t\t\t\t\t\t<div class=\"descr_raw\">";
            if (isset($context["bbcode"])) { $_bbcode_ = $context["bbcode"]; } else { $_bbcode_ = null; }
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo $this->getAttribute($_bbcode_, "p", array($this->getAttribute($_product_, "description"), 1, ), "method");
            echo "</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"p-terms\">";
            // line 104
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_nl2br_filter(twig_escape_filter($this->env, $this->getAttribute($_product_, "terms"), "html", null, true));
            echo "</div>
\t\t\t\t\t\t\t\t\t\t";
            // line 106
            echo "                ";
        }
        // line 107
        echo "                ";
        if (isset($context["tab"])) { $_tab_ = $context["tab"]; } else { $_tab_ = null; }
        if (($_tab_ == "questions")) {
            // line 108
            echo "                    ";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            if ($this->getAttribute($_app_, "user")) {
                echo "<a href=\"/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
                echo "/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
                echo ".html?tab=add\" class=\"g-button g-button-small g-button-submit modal-pp\">Add question</a>";
            }
            // line 109
            echo "                    <ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
                    ";
            // line 110
            if (isset($context["questions"])) { $_questions_ = $context["questions"]; } else { $_questions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_questions_);
            foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
                // line 111
                echo "                    <div style=\"margin: 15px 0;border-bottom:1px solid #cacaca;\">
                        <div style=\"\">By: ";
                // line 112
                if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_question_, "User"), "first_name"), "html", null, true);
                echo "</div>
                        <div style=\"padding:5px 0 10px 10px;\"><span class=\"label2 label-info\">question</span> ";
                // line 113
                if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
                echo twig_nl2br_filter(twig_escape_filter($this->env, $this->getAttribute($_question_, "question"), "html", null, true));
                echo "</div>
                        ";
                // line 114
                if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
                if ($this->getAttribute($_question_, "Answer")) {
                    // line 115
                    echo "                        ";
                    if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($_question_, "Answer"));
                    foreach ($context['_seq'] as $context["_key"] => $context["answer"]) {
                        // line 116
                        echo "                        <div style=\"margin: 10px 0 0 15px;padding-top:5px;border-top:1px solid #cacaca;\">
                            <div style=\"\">By: ";
                        // line 117
                        if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_answer_, "User"), "first_name"), "html", null, true);
                        echo "</div>
                            <div style=\"padding:5px 0 10px 10px;\"><span class=\"label2 label-important\">answer</span> ";
                        // line 118
                        if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
                        echo twig_nl2br_filter(twig_escape_filter($this->env, $this->getAttribute($_answer_, "answer"), "html", null, true));
                        echo "</div>
                        </div>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['answer'], $context['_parent'], $context['loop']);
                    $context = array_merge($_parent, array_intersect_key($context, $_parent));
                    // line 121
                    echo "                        ";
                }
                // line 122
                echo "                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 124
            echo "                    <ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
                ";
        }
        // line 126
        echo "\t\t\t\t\t\t\t\t</div>\t\t
            </div>
        </div>
    </div>
<br /><br />
";
        // line 131
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
            // line 132
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "first")) {
                // line 133
                echo "<ul class=\"products_list\">
    <li><h3 class=\"cssfonts--26\">Similar offers</h3></li>
";
            }
            // line 136
            echo "    ";
            $this->env->loadTemplate("inc/productList.twig")->display($context);
            // line 137
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
        // line 139
        echo "<script type=\"text/javascript\">
    \$('#confirm_now').click(function() {
       \$.post('/confirm-deal/'+";
        // line 141
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "id"), "html", null, true);
        echo " );
    });
    \$('#slides .slides_container').css('display', 'block');
    \$('.nav-tabs li a:hover').last().css('border', '0 none');
    \$('#confirm_now').addClass('g-button g-button-submit');
</script>
";
    }

    // line 149
    public function block_right_side($context, array $blocks = array())
    {
        // line 150
        echo "\t\t<div class=\"p-top\">
\t\t\t\t<div class=\"prod-timer clearfix\" style=\"padding:5px;\">
\t\t\t\t\t<div class=\"center strong cssfonts--20\" style=\"color: #7E7E7E\">Deal Ends In</div>
\t\t\t\t\t";
        // line 154
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
        // line 158
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "discount"), "html", null, true);
        echo "%</h5>
\t\t\t\t</div>
\t\t\t\t<div class=\"product-content\">
\t\t\t\t\t<div class=\"blog-right-dwo\"><span>Value</span> <p>";
        // line 161
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "suplier_price")), "html", null, true);
        echo "</p></div>
\t\t\t\t\t<div class=\"blog-right-dwo\"><span>Price</span> <p>";
        // line 162
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "price")), "html", null, true);
        echo "</p></div>
\t\t\t\t\t<div class=\"clearfix\"></div>
\t\t\t\t</div>
\t\t\t\t";
        // line 165
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if (($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") == $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock"))) {
            // line 166
            echo "\t\t\t\t\t<div class=\"blog-right-button\">
\t\t\t\t\t\t";
            // line 168
            echo "\t\t\t\t\t\t\t<div class=\"button_buy\">
\t\t\t\t\t\t\t\t<div class=\"blog-right-grey-left\"></div>
\t\t\t\t\t\t\t\t<div class=\"blog-right-grey-center\">Buy</div>
\t\t\t\t\t\t\t\t<div class=\"blog-right-grey-right\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
            // line 174
            echo "\t\t\t\t\t</div>
\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t<div style=\"margin: 0px 25px;padding-top:2px;\"><img src=\"/images/site/gift_grey.png\" width=\"59\" height=\"60\" /><div style=\"cursor: default; line-height:60px;display:block;color:#cccccc;font-weight:bold;font-size: 16px;text-decoration: none;padding-right:5px;\" class=\"right\">Buy For A Friend</div></div>
\t\t\t\t";
        } else {
            // line 178
            echo "\t\t\t\t\t<div class=\"blog-right-button\">
\t\t\t\t\t\t<a href=\"";
            // line 179
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
            // line 188
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
        // line 190
        echo "\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t<div class=\"prod-box-content\">
\t\t\t\t\t";
        // line 192
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if (($this->getAttribute($_product_, "sold") >= 0)) {
            echo "<div style=\"padding-top:5px;text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "sold"), "html", null, true);
            echo " Offer(s) Bought</div>";
        }
        // line 193
        echo "\t\t\t\t\t";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if (($this->getAttribute($_product_, "sold") >= $this->getAttribute($_product_, "min_sold"))) {
            // line 194
            echo "\t\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            $context["percent"] = intval(floor((($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") * 100) / $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock"))));
            // line 195
            echo "\t\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (((($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") * 100) % $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock")) >= 5)) {
                // line 196
                echo "\t\t\t\t\t\t";
                if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                $context["percent"] = ($_percent_ + 1);
                // line 197
                echo "\t\t\t\t\t\t";
            }
            // line 198
            echo "\t\t\t\t\t\t<div style=\"width: 200px;\">
\t\t\t\t\t\t\t<div id=\"progress1\" class=\"progress\">
\t\t\t\t\t\t\t\t<span style=\"width: ";
            // line 200
            if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
            echo twig_escape_filter($this->env, $_percent_, "html", null, true);
            echo "%;\">
\t\t\t\t\t\t\t\t\t<b>";
            // line 201
            if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
            echo twig_escape_filter($this->env, $_percent_, "html", null, true);
            echo "%</b>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
            // line 205
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") == $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock"))) {
                // line 206
                echo "\t\t\t\t\t\t\t<div style=\"padding-top:5px;text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">Sorry, but that deal offer is already sold out.</div>
\t\t\t\t\t\t";
            } else {
                // line 208
                echo "\t\t\t\t\t\t\t<div style=\"padding-top:5px;text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">Deal is active</div>
\t\t\t\t\t\t";
            }
            // line 210
            echo "\t\t\t\t\t";
        } else {
            // line 211
            echo "\t\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            $context["percent"] = intval(floor((($this->getAttribute($_product_, "sold") * 100) / $this->getAttribute($_product_, "min_sold"))));
            // line 212
            echo "\t\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (((($this->getAttribute($_product_, "sold") * 100) % $this->getAttribute($_product_, "min_sold")) >= 5)) {
                // line 213
                echo "\t\t\t\t\t\t\t";
                if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                $context["percent"] = ($_percent_ + 1);
                // line 214
                echo "\t\t\t\t\t\t";
            }
            // line 215
            echo "\t\t\t\t\t\t";
            // line 216
            echo "\t\t\t\t\t\t<div style=\"width: 200px;\">
\t\t\t\t\t\t\t<div id=\"progress1\" class=\"progress\">
\t\t\t\t\t\t\t\t<span style=\"width: ";
            // line 218
            if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
            echo twig_escape_filter($this->env, $_percent_, "html", null, true);
            echo "%;\">
\t\t\t\t\t\t\t\t\t<b>";
            // line 219
            if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
            echo twig_escape_filter($this->env, $_percent_, "html", null, true);
            echo "%</b>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div style=\"padding-top:5px; width: 230px; margin-left: -15px; text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">";
            // line 223
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, ($this->getAttribute($_product_, "min_sold") - $this->getAttribute($_product_, "sold")), "html", null, true);
            echo " more and the Deal is ON!</div>
\t\t\t\t\t";
        }
        // line 225
        echo "\t\t\t\t</div>
\t\t\t\t
\t\t\t\t";
        // line 232
        echo "\t\t</div>
\t\t<div class=\"p-tags\">
\t\t\t\t";
        // line 234
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
            // line 235
            echo "\t\t\t\t\t\t";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "first")) {
                echo "<h3>Tags</h3>";
            }
            // line 236
            echo "\t\t\t\t\t\t";
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_tag_, "Tag"), "name"), "html", null, true);
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "last")) {
            } else {
                echo ",";
            }
            // line 237
            echo "\t\t\t\t";
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
        // line 238
        echo "\t\t</div>
\t\t<div style=\"padding-top:10px;padding-left:20px;\">
\t\t\t\t<div style=\"font-weight:bold;font-size: 16px;\">Deal's Location</div>
\t\t\t\t<div id=\"map\" align=\"center\" style=\"width: 210px; height: 200px;margin-top:15px; position: relative;overflow: hidden;padding-left:20px;\"></div>
\t\t\t\t<div style=\"padding-top:10px;\">
\t\t\t\t\t\t";
        // line 243
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
        // line 244
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "phone"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t</div>


\t\t<div class=\"right-box-top\">
        <div style=\"color:#fff;font-size: 16px\">Similar products</div>
    </div>
    <div class=\"right-box-content\">
        <div>
            <ul>
            ";
        // line 255
        if (isset($context["other"])) { $_other_ = $context["other"]; } else { $_other_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_other_);
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 256
            echo "                <li style=\"padding:5px;border-bottom:1px solid #cacaca\">
                <div class=\"clearfix\">
                    <a href=\"/";
            // line 258
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
            echo "/";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
            echo ".html\"><img src=\"/images/site/price_tag_view.png\" alt=\"Price_tag_view\" /></a>
                    <a href=\"/";
            // line 259
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
            echo "/";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
            echo ".html\">";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "name"), "html", null, true);
            echo "</a>
                    ";
            // line 260
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "sold") > 0)) {
                echo "<div style=\"padding-left:20px;padding-top:10px;line-height:20px;height:20px\"><img width=\"17\" height=\"18\" title=\"\" src=\"/images/site/check_mark.png\" alt=\"\" /> ";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_product_, "sold"), "html", null, true);
                echo " Offer(s) Bought</div>";
            }
            // line 261
            echo "                </div>
                </li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 264
        echo "            </ul>
                &nbsp;
        </div>
    </div>
    <div class=\"right-box-bottom\">&nbsp;</div>
    <div class=\"right-box-top\">
        <div style=\"color:#fff;font-size: 16px\">Watch Us</div>
    </div>
    <div class=\"right-box-content\">
        <div style=\"text-align:center\">
            <a href=\"https://www.youtube.com/watch?v=pMCPHVjKQdE\" rel=\"prettyPhoto\" title=\"\"><img src=\"/images/default.jpg\" alt=\"WinMaWeb\" width=\"240\" /></a>
        </div></div>
    <div class=\"right-box-bottom\">&nbsp;</div>
";
    }

    public function getTemplateName()
    {
        return "product.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
