<?php

/* myaccount/agentCommision.twig */
class __TwigTemplate_99e41f16dd89bf5b3fb796a7f1791f11 extends Twig_Template
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
        echo "\t<h1>Agent Commision</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t<ul class=\"pagination clearfix\">";
        // line 18
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t\t<div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">Date</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Product</div>
\t\t\t<div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">Type</div>
\t\t\t<div class=\"yui3-u\" style=\"width:120px;\">Commission</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Product Price</div>
\t\t</div>
\t\t";
        // line 27
        if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_transactions_);
        foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
            // line 28
            echo "\t\t\t<div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">";
            // line 29
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
            // line 30
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "product_name")) {
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "product_name"), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
            // line 31
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "quantity")) {
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">";
            // line 32
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "do-share-do-receive")) {
                echo "Coupon money";
            } elseif (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "merchant-commission")) {
                echo "Agent-Commission";
            } else {
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array")), "html", null, true);
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:120px;";
            // line 33
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "site-fee")) {
                echo "color:#DD3C10;font-weight: bold";
            }
            echo "\"><strong>";
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
            echo "</strong></div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
            // line 34
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "product_price"), "html", null, true);
            echo "</div>
\t\t\t</div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 37
        echo "\t\t<ul class=\"pagination clearfix\">";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t</div>
\t<div class=\"ma_bottom\"></div>
";
    }

    // line 42
    public function block_right_side($context, array $blocks = array())
    {
        // line 43
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 44
            echo "        ";
            $context["ma_menu"] = "agentCommision";
            // line 45
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 46
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/agentCommision.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
