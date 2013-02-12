<?php

/* myaccount/receivedGiftVouchers.twig */
class __TwigTemplate_ab8dc852791eec676e2cf2a0332bfdba extends Twig_Template
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
        echo "\t<h1>Received Gift Vouchers</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t<a href=\"";
        // line 18
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyBoughtDeals", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">My Bought Deals</a>
\t\t<a href=\"";
        // line 19
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyVouchers", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">My Vouchers</a>
\t\t<a href=\"";
        // line 20
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountReceivedGiftVouchers", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-submit ajax-link\" style=\"min-width:10px;\">Received Gift Vouchers</a>
\t\t<br /><br />
\t\t<div class=\"info-blue\">
\t\t\t<p>
\t\t\t\tIn My Vouchers Section you may view all the of the vouchers you have purchased from WinMaWeb.
\t\t\t\tOnce a Voucher is redeemed or has expired then it will no longer be available for use.<br /><br />
\t\t\t\tUnder Actions you may select the Voucher button to download the Pdf file and print it for use.
\t\t\t</p>
\t\t</div>
\t\t<br /><br />
\t\t<ul class=\"pagination clearfix\">";
        // line 30
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t\t<div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
\t\t\t<div class=\"yui3-u\" style=\"width:90px;\">Created</div>
\t\t\t<div class=\"yui3-u\" style=\"width:90px;\">Expires</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Product</div>
\t\t\t<div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
\t\t\t<div class=\"yui3-u\" style=\"width:120px;\">Cost</div>
\t\t\t<div class=\"yui3-u\" style=\"width:150px;\">Actions</div>
\t\t</div>
\t\t";
        // line 39
        if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_transactions_);
        foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
            // line 40
            echo "\t\t\t<div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed;";
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ((!(null === $this->getAttribute($_transaction_, "verifier_id")))) {
                echo "color: #cacaca";
            }
            echo "\">
\t\t\t\t<div class=\"yui3-u\" style=\"width:90px;\">";
            // line 41
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:90px;\">";
            // line 42
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "expire_at"), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
            // line 43
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "name")) {
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "name"), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
            // line 44
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "quantity")) {
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:120px;\"><strong>";
            // line 45
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "price")), "html", null, true);
            echo "</strong></div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:150px;\">
\t\t\t\t\t<a href=\"";
            // line 47
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(((("@myAccountCouponDetails?coupon_id=" . $this->getAttribute($_transaction_, "id")) . "&friend=") . $this->getAttribute($_transaction_, "friend")), ), "method"), "html", null, true);
            echo "\" class=\"g-button ";
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transaction_, "friend") == 0)) {
                echo "g-button-share";
            } else {
                echo "g-button-submit";
            }
            echo " modal-normal\" title=\"Voucher Details\"  style=\"padding:2px;height:15px;line-height:15px;\">";
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transaction_, "friend") == 0)) {
                echo "Voucher";
            } else {
                echo "Gift Voucher";
            }
            echo "</a>
\t\t\t\t</div>
\t\t\t</div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 51
        echo "\t\t<ul class=\"pagination clearfix\">";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t</div>
\t<div class=\"ma_bottom\"></div>
";
    }

    // line 56
    public function block_right_side($context, array $blocks = array())
    {
        // line 57
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 58
            echo "\t\t";
            $context["ma_menu"] = "myBoughtDeals";
            // line 59
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 60
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/receivedGiftVouchers.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
