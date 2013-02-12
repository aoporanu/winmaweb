<?php

/* myaccount/myBoughtDeals.twig */
class __TwigTemplate_cc228642c3d1e803fd16d4e1dd2dd2dc extends Twig_Template
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
        echo "\t<h1>My Bought Deals</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t<a href=\"";
        // line 18
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyBoughtDeals", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-submit ajax-link\" style=\"min-width:10px;\">My Bought Deals</a>
\t\t<a href=\"";
        // line 19
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyVouchers", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">My Vouchers</a>
\t\t<br /><br />
\t\t<div class=\"info-blue\">
\t\t\t<p>
\t\t\t\tIn My Bought Deals Section you may view all of the purchases you have made through WinMaWeb.<br />
\t\t\t\t";
        // line 24
        if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
        if ($this->getAttribute($_userObj_, "hasRole", array("SHOP", ), "method")) {
            // line 25
            echo "\t\t\t\t\t<br />In addition, Merchants may view their verification and test transaction here.  This small transfer is done to verify that the merchant's financial information is both correct and functional.
\t\t\t\t";
        }
        // line 27
        echo "\t\t\t</p>
\t\t</div>
\t\t<br />
\t\t<div class=\"info-blue\">
\t\t\t<p>The blue colored deal you bought means that the deal offer is not yet active. Check the deal offer to see how many more need to be purchased until the deal is on</p>
\t\t</div>
\t\t<br /><br />
\t\t<ul class=\"pagination clearfix\">";
        // line 34
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t\t<div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">Date</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Product</div>
\t\t\t<div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">From</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Type</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Cost</div>
\t\t\t<div class=\"yui3-u\" style=\"width:50px;\">Actions</div>
\t\t</div>
\t\t";
        // line 44
        if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_transactions_);
        foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
            // line 45
            echo "\t\t\t<div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed;";
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($this->getAttribute($_transaction_, "Product"), "sold") < $this->getAttribute($this->getAttribute($_transaction_, "Product"), "min_sold"))) {
                echo " color: blue;";
            }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transaction_, "status") == (-1))) {
                echo "color:red";
            }
            echo "\">
\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">";
            // line 46
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
            // line 47
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "product_name")) {
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "product_name"), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
            // line 48
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "quantity")) {
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
            // line 49
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ((($this->getAttribute($this->getAttribute($_transaction_, "Receiver"), "username") && ($this->getAttribute($_transaction_, "transaction_type") != "8")) && ($this->getAttribute($_transaction_, "transaction_type") != "55"))) {
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_transaction_, "Receiver"), "username"), "html", null, true);
            } else {
                echo " You ";
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">
\t\t\t\t\t";
            // line 51
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ((($this->getAttribute($_transaction_, "transaction_type") == "1") || ($this->getAttribute($_transaction_, "transaction_type") == "80"))) {
                echo "Deal Purchase(from ";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transaction_, "transaction_type") == "80")) {
                    echo "WMW Credits";
                }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transaction_, "transaction_type") == "1")) {
                    echo "wallet";
                }
                echo ")";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($this->getAttribute($_transaction_, "Product"), "sold") < $this->getAttribute($this->getAttribute($_transaction_, "Product"), "min_sold"))) {
                    echo " (Deal will become active after ";
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($_transaction_, "Product"), "min_sold") - $this->getAttribute($this->getAttribute($_transaction_, "Product"), "sold")), "html", null, true);
                    echo " more are purchased)";
                }
            } else {
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array")), "html", null, true);
            }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transaction_, "status") == (-1))) {
                echo " (Refunded)";
            }
            // line 52
            echo "\t\t\t\t</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;";
            // line 53
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "deposit")) {
                echo "color:#29691d;font-weight: bold";
            }
            echo "\"><strong>";
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
            echo "</strong></div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:50px;\">
\t\t\t\t\t<a href=\"";
            // line 55
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountCouponDetails?coupon_id=" . $this->getAttribute($_transaction_, "cid")), ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-share modal-normal\" title=\"Voucher Details\"  style=\"padding:2px;height:15px;line-height:15px;\">Voucher</a>
\t\t\t\t\t";
            // line 57
            echo "\t\t\t\t</div>
\t\t\t</div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 60
        echo "\t\t<ul class=\"pagination clearfix\">";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t</div>
\t<div class=\"ma_bottom\"></div>
";
    }

    // line 65
    public function block_right_side($context, array $blocks = array())
    {
        // line 66
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 67
            echo "\t\t";
            $context["ma_menu"] = "myBoughtDeals";
            // line 68
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 69
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/myBoughtDeals.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
