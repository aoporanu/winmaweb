<?php

/* myaccount/soldVouchers.twig */
class __TwigTemplate_cca054d6f01f9e234e62b55da8a6a429 extends Twig_Template
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
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 5
            echo "        ";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 6
            echo "    ";
        }
    }

    // line 8
    public function block_js($context, array $blocks = array())
    {
        // line 9
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 10
            echo "        ";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 11
            echo "    ";
        }
    }

    // line 14
    public function block_content_page($context, array $blocks = array())
    {
        // line 15
        echo "<h1>Sold Vouchers</h1>
<div class=\"ma_top\"></div>
<div class=\"ma_content\">
\t<a href=\"";
        // line 18
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountSoldVouchers?format=csv", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-share\">Download CSV</a>
\t<br /><br />
            <ul class=\"pagination clearfix\">";
        // line 20
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
            <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">Created</div>
                <div class=\"yui3-u\" style=\"width:80px;\">Expires</div>
                <div class=\"yui3-u\" style=\"width:100px;\">Product</div>
                <div class=\"yui3-u\" style=\"width:80px;text-align:center\">Buyer</div>
                <div class=\"yui3-u\" style=\"width:100px;\">Cost</div>
                <div class=\"yui3-u\" style=\"width:150px;\">Voucher Number</div>
            </div>
            ";
        // line 29
        if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_transactions_);
        foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
            // line 30
            echo "            <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">";
            // line 31
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
            echo "</div>
                <div class=\"yui3-u\" style=\"width:80px;\">";
            // line 32
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "expire_at"), "html", null, true);
            echo "</div>
                <div class=\"yui3-u\" style=\"width:100px;\">";
            // line 33
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "name")) {
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "name"), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</div>
                <div class=\"yui3-u\" style=\"width:80px;text-align:center\">";
            // line 34
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_transaction_, "Transaction"), "Sender"), "first_name"), "html", null, true);
            echo " ";
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_transaction_, "Transaction"), "Sender"), "last_name"), "html", null, true);
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "Friend")) {
                echo " (<strong>For friend:</strong> ";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_transaction_, "Friend"), "first_name"), "html", null, true);
                echo " ";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_transaction_, "Friend"), "last_name"), "html", null, true);
                echo ")";
            }
            echo "</div>
                <div class=\"yui3-u\" style=\"width:100px;\"><strong>";
            // line 35
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "price")), "html", null, true);
            echo "</strong></div>
                <div class=\"yui3-u\" style=\"width:150px;\">
                ";
            // line 37
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "code2"), "html", null, true);
            echo "
                </div>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 41
        echo "            <ul class=\"pagination clearfix\">";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t</div>
    <div class=\"ma_bottom\"></div>
";
    }

    // line 46
    public function block_right_side($context, array $blocks = array())
    {
        // line 47
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 48
            echo "        ";
            $context["ma_menu"] = "soldVouchers";
            // line 49
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 50
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/soldVouchers.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
