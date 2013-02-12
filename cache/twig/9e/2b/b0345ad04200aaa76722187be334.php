<?php

/* alldeals.twig */
class __TwigTemplate_9e2bb0345ad04200aaa76722187be334 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
            'js' => array($this, 'block_js'),
            'css' => array($this, 'block_css'),
            'main_menu' => array($this, 'block_main_menu'),
            'content_page' => array($this, 'block_content_page'),
            'right_side' => array($this, 'block_right_side'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getAttribute($this->getContext($context, "app"), "ajax")) ? ("layouts/ajax.twig") : ("layouts/layout.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_page_title($context, array $blocks = array())
    {
        echo "All deals :: DailyDeals";
    }

    // line 5
    public function block_js($context, array $blocks = array())
    {
        // line 6
        echo "    <script type=\"text/javascript\" src=\"/js/jquery.countdown.min.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/jquery-ui-1.8.16.custom.min.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/slides.min.jquery.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/jquery.prettyPhoto.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/product.js\"></script>
\t\t<script type=\"text/javascript\" src=\"/js/function.js\"></script>
";
    }

    // line 14
    public function block_css($context, array $blocks = array())
    {
        // line 15
        echo "\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/ui-lightness/jquery-ui-1.8.16.custom.css\" />
\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/prettyPhoto.css\" />
";
    }

    // line 19
    public function block_main_menu($context, array $blocks = array())
    {
        // line 20
        echo "<div class=\"main_menu_container\">
    <ul class=\"main_menu\">
        <li><a href=\"/\">Today's Deal</a></li>
        <li><a href=\"/all-deals\" class=\"active\">All Deals</a></li>
        <li><a href=\"/recent-deals\">Recent Deals</a></li>
        <li><a href=\"/charities\">Charities</a></li>
\t\t\t\t<li><a href=\"/how-its-working\" class=\"white-button\">How Does It Work?</a></li>
\t\t\t\t";
        // line 27
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($this->getAttribute($_app_, "shopCart"), "product_id")) {
            echo "<li class=\"h_basket\"><a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@paymentShopCart", ), "method"), "html", null, true);
            echo "\" class=\"basket\">Shopcart</a></li>";
        }
        // line 28
        echo "    </ul>
</div>
";
    }

    // line 32
    public function block_content_page($context, array $blocks = array())
    {
        // line 33
        echo "\t\t<div style=\"padding: 0px 14px;\">
\t\t";
        // line 34
        $context["i"] = 0;
        // line 35
        echo "\t\t";
        if (isset($context["products"])) { $_products_ = $context["products"]; } else { $_products_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_products_);
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
            // line 36
            echo "\t\t\t";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            $context["i"] = ($_i_ + 1);
            // line 37
            echo "\t\t\t";
            $this->env->loadTemplate("inc/productList.twig")->display($context);
            // line 38
            echo "\t\t\t";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            if ((($_i_ % 2) != 0)) {
                // line 39
                echo "\t\t\t<div class=\"border-vertical\"></div>
\t\t\t";
            }
            // line 41
            echo "\t\t";
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
        // line 42
        echo "\t\t</div>
";
    }

    // line 45
    public function block_right_side($context, array $blocks = array())
    {
        echo "<a title=\"Help\" style=\"font-size: 11px\" class=\"help-link\" href=\"#\">help</a><div class=\"inv help-message\">";
        if (isset($context["helpObj"])) { $_helpObj_ = $context["helpObj"]; } else { $_helpObj_ = null; }
        echo $this->getAttribute($this->getAttribute($_helpObj_, "getHelp", array(12, ), "method"), "content");
        echo "</div>
<br /><br />
\t\t<div class=\"search_container\">
\t\t\t<form name=\"frmSearch\" class=\"search-form\" method=\"get\" action=\"/search\" enctype=\"application/x-www-form-urlencoded\">
\t\t\t\t";
        // line 49
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("term", "", ), "method"), "html", null, true);
        echo "
\t\t\t\t<input class=\"search_button\" type=\"submit\" value=\"Search\" />
\t\t\t</form>
\t\t</div>
\t\t
\t\t<div class=\"right-box-top\">
        <div style=\"color:#fff;font-size: 16px\">Other deals</div>
    </div>
    <div class=\"right-box-content\">
        <div>
            <ul>
            ";
        // line 60
        if (isset($context["other"])) { $_other_ = $context["other"]; } else { $_other_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_other_);
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 61
            echo "                <li style=\"padding:10px 5px;border-bottom:1px solid #cacaca\">
                <div class=\"clearfix\">
\t\t\t\t\t\t\t\t\t<a href=\"/";
            // line 63
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
            echo "/";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
            echo ".html\"><img style=\"vertical-align: middle;\" src=\"/images/site/price_tag_view.png\" alt=\"Price_tag_view\" /></a>
                  <a href=\"/";
            // line 64
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
            // line 65
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "sold") > 0)) {
                echo "<div style=\"padding-left:20px;padding-top:10px;line-height:20px;height:20px\"><img style=\"vertical-align: middle;\" width=\"17\" height=\"18\" title=\"\" src=\"/images/site/check_mark.png\" alt=\"\" /> ";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_product_, "sold"), "html", null, true);
                echo " bought</div>";
            }
            // line 66
            echo "                </div>
                </li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 69
        echo "            </ul>
                &nbsp;
        </div>
    </div>
    <div class=\"right-box-bottom\">&nbsp;</div>
\t\t
    <div class=\"right-box-top\">
        <div style=\"color:#fff;font-size: 16px\">Watch Us</div>
    </div>
    <div class=\"right-box-content\">
        <div style=\"text-align:center\">
            <a href=\"https://www.youtube.com/watch?v=pMCPHVjKQdE\" rel=\"prettyPhoto\" title=\"\"><img src=\"/images/default.jpg\" alt=\"WinMaWeb\" width=\"240\" /></a>
        </div></div>
    <div class=\"right-box-bottom\">&nbsp;</div>
\t\t
\t\t<div class=\"right-box-top\">
        <div style=\"color:#fff;font-size: 16px\">Tags</div>
    </div>
    <div class=\"right-box-content\">
        <div class=\"tagcloud\">
\t\t\t\t\t";
        // line 89
        $context["max"] = 0;
        // line 90
        echo "\t\t\t\t\t";
        $context["min"] = 1;
        // line 91
        echo "\t\t\t\t\t";
        if (isset($context["tags"])) { $_tags_ = $context["tags"]; } else { $_tags_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_tags_);
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 92
            echo "\t\t\t\t\t\t";
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            if (isset($context["max"])) { $_max_ = $context["max"]; } else { $_max_ = null; }
            if (($this->getAttribute($_tag_, "nr") > $_max_)) {
                // line 93
                echo "\t\t\t\t\t\t";
                if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
                $context["max"] = $this->getAttribute($_tag_, "nr");
                // line 94
                echo "\t\t\t\t\t\t";
            }
            // line 95
            echo "\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 96
        echo "\t\t\t\t\t";
        if (isset($context["tags"])) { $_tags_ = $context["tags"]; } else { $_tags_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_tags_);
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 97
            echo "\t\t\t\t\t\t";
            if (isset($context["max"])) { $_max_ = $context["max"]; } else { $_max_ = null; }
            if (isset($context["min"])) { $_min_ = $context["min"]; } else { $_min_ = null; }
            $context["size"] = ($_max_ - $_min_);
            // line 98
            echo "\t\t\t\t\t\t";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            if (($_size_ == 0)) {
                // line 99
                echo "\t\t\t\t\t\t";
                $context["size"] = 1;
                // line 100
                echo "\t\t\t\t\t\t";
            }
            // line 101
            echo "\t\t\t\t\t\t";
            if (isset($context["max"])) { $_max_ = $context["max"]; } else { $_max_ = null; }
            if (($_max_ < 5)) {
                // line 102
                echo "\t\t\t\t\t\t";
                if (isset($context["max"])) { $_max_ = $context["max"]; } else { $_max_ = null; }
                if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
                $context["size"] = ((14 / (5 - $_max_)) / $_size_);
                // line 103
                echo "\t\t\t\t\t\t";
            } else {
                // line 104
                echo "\t\t\t\t\t\t";
                if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
                $context["size"] = (14 / $_size_);
                // line 105
                echo "\t\t\t\t\t\t";
            }
            // line 106
            echo "\t\t\t\t\t\t";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            if (isset($context["min"])) { $_min_ = $context["min"]; } else { $_min_ = null; }
            $context["size"] = (8 + ($_size_ * ($this->getAttribute($_tag_, "nr") - $_min_)));
            // line 107
            echo "\t\t\t\t\t\t<a href=\"/tag/";
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_tag_, "name"), "html", null, true);
            echo "\" style=\"font-size: ";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo twig_escape_filter($this->env, $_size_, "html", null, true);
            echo "pt;\">";
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_tag_, "name"), "html", null, true);
            echo "</a>&nbsp;&nbsp;&nbsp;
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 109
        echo "\t\t\t\t</div>
    </div>
    <div class=\"right-box-bottom\">&nbsp;</div>
\t\t
";
    }

    public function getTemplateName()
    {
        return "alldeals.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
