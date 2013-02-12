<?php

/* myaccount/contract/step3.twig */
class __TwigTemplate_0961b1d2acc123228321e9cfca9155f1 extends Twig_Template
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
        return $this->env->resolveTemplate((($this->getContext($context, "imgajax")) ? ("layouts/ajax.twig") : ("layouts/layout.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_css($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        if (isset($context["imgajax"])) { $_imgajax_ = $context["imgajax"]; } else { $_imgajax_ = null; }
        if ((!$_imgajax_)) {
            // line 6
            echo "        ";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 7
            echo "    ";
        }
    }

    // line 9
    public function block_js($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        if (isset($context["imgajax"])) { $_imgajax_ = $context["imgajax"]; } else { $_imgajax_ = null; }
        if ((!$_imgajax_)) {
            // line 11
            echo "        ";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 12
            echo "    ";
        }
    }

    // line 15
    public function block_content_page($context, array $blocks = array())
    {
        // line 16
        echo "    <h1>Request Merchant Account <a title=\"Help\" style=\"font-size: 11px\" class=\"help-link\" href=\"#\">help</a><div class=\"inv help-message\">";
        if (isset($context["helpObj"])) { $_helpObj_ = $context["helpObj"]; } else { $_helpObj_ = null; }
        echo $this->getAttribute($this->getAttribute($_helpObj_, "getHelp", array(9, ), "method"), "content");
        echo "</div></h1>
    <div class=\"ma_top\"></div>
    <div class=\"ma_content\">
        <ul class=\"steps clearfix\">
            <li class=\"steps_bg steps_done clearfix\"><div class=\"no left\">1</div><div class=\"left\">Information</div></li>
            <li class=\"steps_bg steps_done clearfix\"><div class=\"no left\">2</div><div class=\"left\">Review</div></li>
            <li class=\"steps_bg steps_active clearfix\"><div class=\"no left\">3</div><div class=\"left\">Payment</div></li>
        </ul>
        <div class=\"info-blue\">
            ";
        // line 26
        echo "                <p>Thank you for sending in your information. To proceed with your account upgrade you must send in a Merchant Verification Fee and Test Transaction of ";
        if (isset($context["merchantFee"])) { $_merchantFee_ = $context["merchantFee"]; } else { $_merchantFee_ = null; }
        echo twig_escape_filter($this->env, twig_currency($_merchantFee_), "html", null, true);
        echo " This fee is meant to verify your financial and identify details with WinMaWeb. After it is sent your account will automatically be upgraded to that of a Merchant Account.</p>
        </div>
        <br />
        ";
        // line 29
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if (isset($context["merchantFee"])) { $_merchantFee_ = $context["merchantFee"]; } else { $_merchantFee_ = null; }
        if (($this->getAttribute($this->getAttribute($_app_, "user"), "wallet") >= $_merchantFee_)) {
            // line 30
            echo "            <a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountContract?pay=1", ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-submit aja-link\">Pay</a>
        ";
        } else {
            // line 32
            echo "            You need more money in your wallet, please deposit more money first.
        ";
        }
        // line 34
        echo "    </div>
    <div class=\"ma_bottom\"></div>
";
    }

    // line 38
    public function block_right_side($context, array $blocks = array())
    {
        // line 39
        echo "    ";
        if (isset($context["imgajax"])) { $_imgajax_ = $context["imgajax"]; } else { $_imgajax_ = null; }
        if ((!$_imgajax_)) {
            // line 40
            echo "        ";
            $context["ma_menu"] = "contract";
            // line 41
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 42
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/contract/step3.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
