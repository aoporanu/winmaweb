<?php

/* myaccount/myWMWCredits.twig */
class __TwigTemplate_ff1c118eb8efe11afdffdf8bb8555d5e extends Twig_Template
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
        echo "\t<h1>My WMW Credits</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t<div class=\"info-blue\">
\t\t\t<p>In the WMW Credits page you may view all the purchases made by the members in your 5th Tier.  All the commissions you receive are automatically deposited to your WinMaWeb Account.</p>
\t\t</div>
\t\t<br /><br />
\t\t<ul class=\"pagination clearfix\">";
        // line 22
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t\t<div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">Date</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Product</div>
\t\t\t<div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
\t\t\t";
        // line 28
        echo "\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">Type</div>
\t\t\t<div class=\"yui3-u\" style=\"width:120px;\">Amount</div>
\t\t\t<div class=\"yui3-u\" style=\"width:120px;\">Product Price</div>
\t\t</div>
\t\t";
        // line 32
        if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_transactions_);
        foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
            // line 33
            echo "\t\t\t<div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">";
            // line 34
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
            // line 35
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "product_name")) {
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "product_name"), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
            // line 36
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "quantity")) {
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</div>
\t\t\t\t";
            // line 38
            echo "\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">";
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "level-commission")) {
                echo " 5th Tier Commission ";
            } else {
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array")), "html", null, true);
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:120px;";
            // line 39
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "site-fee")) {
                echo "color:#DD3C10;font-weight: bold";
            }
            echo "\"><strong>";
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
            echo "</strong></div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:120px;\">";
            // line 40
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "product_price")), "html", null, true);
            echo "</div>
\t\t\t</div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 43
        echo "\t\t<ul class=\"pagination clearfix\">";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t</div>
\t<div class=\"ma_bottom\"></div>
";
    }

    // line 48
    public function block_right_side($context, array $blocks = array())
    {
        // line 49
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 50
            echo "\t\t";
            $context["ma_menu"] = "myWMWCredits";
            // line 51
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 52
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/myWMWCredits.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
