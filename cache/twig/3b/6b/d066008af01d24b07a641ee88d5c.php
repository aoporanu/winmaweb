<?php

/* myaccount/products/getmerchantdeals.twig */
class __TwigTemplate_3b6bd066008af01d24b07a641ee88d5c extends Twig_Template
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
        return $this->env->resolveTemplate((($this->getAttribute($this->getContext($context, "app"), "ajax")) ? ("layouts/ajax.twig") : ("layouts/layout.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_css($context, array $blocks = array())
    {
        // line 4
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 5
            echo "\t\t";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 6
            echo "\t";
        }
    }

    // line 8
    public function block_js($context, array $blocks = array())
    {
        // line 9
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 10
            echo "\t\t";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 11
            echo "\t";
        }
    }

    // line 14
    public function block_content_page($context, array $blocks = array())
    {
        // line 15
        echo "\t<h1>My Pending Offers</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t<ul class=\"pagination clearfix\">";
        // line 18
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t\t<ul class=\"ma_products\">
\t\t\t";
        // line 20
        if (isset($context["products"])) { $_products_ = $context["products"]; } else { $_products_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_products_);
        $context['_iterated'] = false;
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
            // line 21
            echo "\t\t\t\t<li";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "last")) {
                echo " class=\"last\"";
            }
            echo ">
\t\t\t\t\t<div class=\"yui3-g\">
\t\t\t\t\t\t<div class=\"yui3-u-1-4\">
\t\t\t\t\t\t\t";
            // line 24
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if ($this->getAttribute($this->getAttribute($_product_, "ProductMedia"), 0)) {
                // line 25
                echo "\t\t\t\t\t\t\t\t<div style=\"width:120px;height:67px;\"><a href=\"/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
                echo "/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
                echo ".html\"><img src=\"";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductMedia"), 0), "dir"), "html", null, true);
                echo "/thumb120x67/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductMedia"), 0), "file_name"), "html", null, true);
                echo "_";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductMedia"), 0), "id"), "html", null, true);
                echo ".";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductMedia"), 0), "ext"), "html", null, true);
                echo "\" width=\"120\" height=\"67\" style=\"border:2px solid #fff;padding:1px;\" /></a></div>
\t\t\t\t\t\t\t";
            } else {
                // line 27
                echo "\t\t\t\t\t\t\t\t<div style=\"width:120px;height:67px;border:2px solid #fff;padding:1px;\"><a href=\"/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
                echo "/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
                echo ".html\">No image</a></div>
\t\t\t\t\t\t\t";
            }
            // line 29
            echo "\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"yui3-u-3-4\">
\t\t\t\t\t\t\t<div class=\"yui3-g\">
                                <div class=\"yui3-u-3-4\" style=\"width:65%;\">
\t\t\t\t\t\t\t\t\t<h2>";
            // line 33
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "name"), "html", null, true);
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == (-2))) {
                echo " (Product expired whitout having the minimum bought deals)";
            }
            echo "</h2>
\t\t\t\t\t\t\t\t\t";
            // line 35
            echo "\t\t\t\t\t\t\t\t\t<div style=\"padding-bottom:10px;\">
\t\t\t\t\t\t\t\t\t\t";
            // line 36
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if ((twig_date_format_filter($this->getAttribute($_product_, "starttime"), "Y-m-d H:i:s") > twig_date_format_filter("now", "Y-m-d H:i:s"))) {
                echo "Start on: 
\t\t\t\t\t\t\t\t\t\t\t<span style=\"font-weight:bold\">";
                // line 37
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_product_, "starttime"), "Y-m-d H:i:s"), "html", null, true);
                echo "</span>
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 39
            echo "\t\t\t\t\t\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (((twig_date_format_filter($this->getAttribute($_product_, "endtime"), "Y-m-d H:i:s") > twig_date_format_filter("now", "Y-m-d H:i:s")) && (twig_date_format_filter($this->getAttribute($_product_, "starttime"), "Y-m-d H:i:s") < twig_date_format_filter("now", "Y-m-d H:i:s")))) {
                echo "Expire on: 
\t\t\t\t\t\t\t\t\t\t\t<span style=\"font-weight:bold\">";
                // line 40
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_product_, "endtime"), "Y-m-d H:i:s"), "html", null, true);
                echo "</span>
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 42
            echo "\t\t\t\t\t\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if ((twig_date_format_filter($this->getAttribute($_product_, "endtime"), "Y-m-d H:i:s") < twig_date_format_filter("now", "Y-m-d H:i:s"))) {
                echo "Expired: 
\t\t\t\t\t\t\t\t\t\t\t<span style=\"font-weight:bold\">";
                // line 43
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_product_, "endtime"), "Y-m-d H:i:s"), "html", null, true);
                echo "</span>
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 45
            echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"yui3-g\">
\t\t\t\t\t\t\t\t\t\t<div class=\"yui3-u-1-3\">
\t\t\t\t\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t\t\t\t\t<div>Sold: <span style=\"font-weight:bold;color: #992a1b\">";
            // line 49
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == (-2))) {
                echo "-";
            } else {
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_product_, "sold"), "html", null, true);
            }
            echo "</span></div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"yui3-u-2-3\">
\t\t\t\t\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t\t\t\t\tStatus: 
\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 55
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == 0)) {
                echo "<span style=\"color:#23A4FF\">pending</span>";
            }
            // line 56
            echo "\t\t\t\t\t\t\t\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == 1)) {
                echo "<span style=\"color:#3d9400\">Accepted</span><br/> Merchant Factor: ";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, (100 - $this->getAttribute($_product_, "factor")), "html", null, true);
                echo "%";
            }
            // line 57
            echo "\t\t\t\t\t\t\t\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == (-1))) {
                echo "<span style=\"color:#992a1b\">Rejected</span>";
            }
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == (-2))) {
                echo "<span style=\"color:#992a1b\">Expired</span>";
            }
            // line 58
            echo "\t\t\t\t\t\t\t\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == 2)) {
                echo "<span style=\"color:red\">Not confirmed</span>";
            }
            // line 59
            echo "\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
                                    <div class=\"yui3-u-1-4\" style=\"width:35%;\">
\t\t\t\t\t\t\t\t\t<ul class=\"ma-product-settings\">
\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
            // line 65
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myProductsGallery?id=" . $this->getAttribute($_product_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"modal-prodgal\">Gallery</a></li>
\t\t\t\t\t\t\t\t\t\t";
            // line 66
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") != (-2))) {
                echo "<li><a href=\"";
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myProducts?ac=prices&pid=" . $this->getAttribute($_product_, "id")), ), "method"), "html", null, true);
                echo "\" class=\"modal-normal\" title=\"Prices\">Prices</a></li>";
            }
            // line 67
            echo "\t\t\t\t\t\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == 0)) {
                echo "<li><a href=\"";
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myProductsDelete?id=" . $this->getAttribute($_product_, "id")), ), "method"), "html", null, true);
                echo "\" class=\"ajax-del\" style=\"color:#992a1b\">Delete</a></li>";
            }
            // line 68
            echo "\t\t\t\t\t\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == 1)) {
                // line 69
                echo "\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myProducts?ac=questions&id=" . $this->getAttribute($_product_, "id")), ), "method"), "html", null, true);
                echo "\" class=\"modal-normal\" title=\"Questions\">Questions</a></li>
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 71
            echo "                                            </ul>
\t\t\t\t\t\t\t\t\t\t";
            // line 72
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            if ((($this->getAttribute($_product_, "status") == 2) && ($this->getAttribute($_product_, "merchant_user_id") == $this->getAttribute($this->getAttribute($_app_, "user"), "id")))) {
                // line 73
                echo "                                            <div class=\"yui3-u\" style=\"padding: 2px 0 2px 10px;\"><a href=\"/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
                echo "/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
                echo ".html\" class=\"modal-addprod g-button g-button-share\">View & Confirm</a></div>
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 75
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</li>
\t\t\t";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        if (!$context['_iterated']) {
            // line 81
            echo "\t\t\t\t<li class=\"last\">You do not have any pending deals</li>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 83
        echo "\t\t</ul>
\t\t<ul class=\"pagination clearfix\">";
        // line 84
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t</div>
\t<div class=\"ma_bottom\"></div>
    <script type=\"text/javascript\">
        \$('.modal-addprod').click(function() {
            \$('.content').css('height', '600px');
        });
    </script>
";
    }

    // line 94
    public function block_right_side($context, array $blocks = array())
    {
        // line 95
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 96
            echo "\t\t";
            $context["ma_menu"] = "pendingOffers";
            // line 97
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 98
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/products/getmerchantdeals.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
