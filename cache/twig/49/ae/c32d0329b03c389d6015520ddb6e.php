<?php

/* product/show.twig */
class __TwigTemplate_49aec32d0329b03c389d6015520ddb6e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'left_menu' => array($this, 'block_left_menu'),
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
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <h1>Deal Offers</h1>
    <div class=\"ma_top\"></div>
    <div class=\"ma_content\">
        <a href=\"";
        // line 7
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageProducts", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["show"])) { $_show_ = $context["show"]; } else { $_show_ = null; }
        if (($_show_ == "")) {
            echo "g-button-submit ";
        }
        echo "ajax-link\">Pending</a>
        <a href=\"";
        // line 8
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageProducts?show=accepted", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["show"])) { $_show_ = $context["show"]; } else { $_show_ = null; }
        if (($_show_ == "accepted")) {
            echo "g-button-submit ";
        }
        echo "ajax-link\">Accepted</a>
        <a href=\"";
        // line 9
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageProducts?show=rejected", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["show"])) { $_show_ = $context["show"]; } else { $_show_ = null; }
        if (($_show_ == "rejected")) {
            echo "g-button-submit ";
        }
        echo "ajax-link\">Rejected</a>
        <ul class=\"pagination clearfix\">";
        // line 10
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
        <ul class=\"ma_products\">
        ";
        // line 12
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
            // line 13
            echo "                <li";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "last")) {
                echo " class=\"last\"";
            }
            echo ">
                    <div class=\"yui3-g\">
                        <div class=\"yui3-u-1-4\">
                            ";
            // line 16
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if ($this->getAttribute($this->getAttribute($_product_, "ProductMedia"), 0)) {
                // line 17
                echo "                            <div style=\"width:120px;height:67px;\"><img src=\"";
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
                echo "\" width=\"120\" height=\"67\" style=\"border:2px solid #fff;padding:1px;\" /></div>
                            ";
            } else {
                // line 19
                echo "                            <div style=\"width:120px;height:67px;border:2px solid #fff;padding:1px;\">No image</div>
                            ";
            }
            // line 21
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div><br/><a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@editProductsGallery?id=" . $this->getAttribute($_product_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"modal-prodgal\">Edit Gallery</a></div>
                        </div>
                        <div class=\"yui3-u-3-4\">
                            <div class=\"yui3-g\">
                                <div class=\"yui3-u-3-4\">
                                    <h2>";
            // line 26
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "name"), "html", null, true);
            echo "</h2>
                                    ";
            // line 28
            echo "                                    <div style=\"padding-bottom:10px;\">
                                        ";
            // line 29
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if ((twig_date_format_filter($this->getAttribute($_product_, "starttime"), "Y-m-d H:i:s") > twig_date_format_filter("now", "Y-m-d H:i:s"))) {
                echo "Start on: 
                                                <span style=\"font-weight:bold\">";
                // line 30
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_product_, "starttime"), "Y-m-d H:i:s"), "html", null, true);
                echo "</span>";
            }
            // line 31
            echo "                                                ";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (((twig_date_format_filter($this->getAttribute($_product_, "endtime"), "Y-m-d H:i:s") > twig_date_format_filter("now", "Y-m-d H:i:s")) && (twig_date_format_filter($this->getAttribute($_product_, "starttime"), "Y-m-d H:i:s") < twig_date_format_filter("now", "Y-m-d H:i:s")))) {
                echo "Expire on: 
                                                <span style=\"font-weight:bold\">";
                // line 32
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_product_, "endtime"), "Y-m-d H:i:s"), "html", null, true);
                echo "</span>";
            }
            // line 33
            echo "                                                ";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if ((twig_date_format_filter($this->getAttribute($_product_, "endtime"), "Y-m-d H:i:s") < twig_date_format_filter("now", "Y-m-d H:i:s"))) {
                echo "Expired: 
                                                <span style=\"font-weight:bold\">";
                // line 34
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_product_, "endtime"), "Y-m-d H:i:s"), "html", null, true);
                echo "</span>";
            }
            // line 35
            echo "                                        Status:";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == 0)) {
                echo "<span style=\"color:#23A4FF\">pending</span>";
            }
            // line 36
            echo "                                        ";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == 1)) {
                echo "<span style=\"color:#3d9400\">accepted</span> <br />WMW Share Factor %: ";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_product_, "factor"), "html", null, true);
                echo "%";
            }
            // line 37
            echo "                                        ";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "status") == (-1))) {
                echo "<span style=\"color:#992a1b\">rejected</span>";
            }
            // line 38
            echo "                                    </div>
                                    <div class=\"yui3-g\">
                                        <div class=\"yui3-u-1-3\">
                                            <div>
                                                <div>Sold: <span style=\"font-weight:bold;color: #992a1b\">";
            // line 42
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "sold"), "html", null, true);
            echo "</span></div>
                                            </div>
                                        </div>
                                        <div class=\"yui3-u-1-3\">
                                            ";
            // line 46
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if ($this->getAttribute($_product_, "is_first")) {
                echo "Product is on First Page";
            }
            // line 47
            echo "                                        </div>
                                       <div class=\"yui3-u-1-3\">
                                            <div style=\"color: #992a1b;font-size: 16px;\">Added by: <a href=\"";
            // line 49
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageUsersActions?id=" . $this->getAttribute($this->getAttribute($_product_, "User"), "id")), ), "method"), "html", null, true);
            echo "\" class=\"modal-user\">";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
            echo "</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"yui3-u-1-4\">
                                    <ul class=\"ma-product-settings\">
                                    ";
            // line 56
            echo "                                    <li><a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageProducts?ac=edit&id=" . $this->getAttribute($_product_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"modal-addprod\">Edit</a></li>
                                    ";
            // line 57
            if (isset($context["show"])) { $_show_ = $context["show"]; } else { $_show_ = null; }
            if (($_show_ == "accepted")) {
                echo "<li><a href=\"";
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageProducts?show=accepted&ac=main&id=" . $this->getAttribute($_product_, "id")), ), "method"), "html", null, true);
                echo "\" class=\"ajax-confirm\" title=\"Are you sure?\">Set On First Page</a></li>";
            }
            // line 58
            echo "                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            ";
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
            // line 65
            echo "            <li class=\"last\">No offer</li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 67
        echo "        </ul>
        <ul class=\"pagination clearfix\">";
        // line 68
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
    </div>
    <div class=\"ma_bottom\"></div>

";
    }

    // line 74
    public function block_left_menu($context, array $blocks = array())
    {
        // line 75
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 76
            echo "        ";
            $context["adm_menu"] = "products";
            // line 77
            echo "        ";
            $this->env->loadTemplate("inc/leftSide.twig")->display($context);
            // line 78
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "product/show.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
