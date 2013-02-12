<?php

/* productOptions.twig */
class __TwigTemplate_48a6017a890ec3bb6fec434374bc2ba1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content_page' => array($this, 'block_content_page'),
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
    public function block_content_page($context, array $blocks = array())
    {
        // line 4
        echo "
<ul>
    ";
        // line 6
        if (isset($context["options"])) { $_options_ = $context["options"]; } else { $_options_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_options_);
        foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
            // line 7
            echo "        <li style=\"padding:10px;border-bottom:1px solid #cacaca\">
            <div class=\"yui3-g\">
\t\t\t\t\t\t\t<div class=\"yui3-u-2-3\" style=\"width: 420px;\">
                    <div style=\"font-size: 16px;font-weight: bold\">";
            // line 10
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_option_, "name"), "html", null, true);
            echo "</div>
                    <div style=\"font-size:11px;\">
                        Value: S\$";
            // line 12
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_option_, "suplier_price"), "html", null, true);
            echo " -
                        Discount: ";
            // line 13
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_option_, "discount"), "html", null, true);
            echo "% -
                        Save: S\$";
            // line 14
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_option_, "money_save"), "html", null, true);
            echo " -
                        <strong>Price: S\$";
            // line 15
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_option_, "price"), "html", null, true);
            echo "</strong>
                    </div>
                    <div style=\"font-size:10px;\">
                        Expires At: ";
            // line 18
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_option_, "expire_at"), "html", null, true);
            echo "
                    </div>
                </div>
                <div class=\"yui3-u-1-3\" style=\"width: 240px;\">
\t\t\t\t\t\t\t\t\t<div style=\"padding-top: 17px;\">";
            // line 22
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_option_, "sold"), "html", null, true);
            echo " Bought (";
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo twig_escape_filter($this->env, ($this->getAttribute($_option_, "stock") - $this->getAttribute($_option_, "sold")), "html", null, true);
            echo " Available) | <a style=\"float: right; margin-top: -7px; padding-left: 3px;\" class=\"g-button g-button-share\" href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(((((("@paymentShopCart?ac=add&product_id=" . $this->getAttribute($_option_, "product_id")) . "&option_id=") . $this->getAttribute($_option_, "id")) . "&friend=") . $_friend_), ), "method"), "html", null, true);
            echo "\">Continue</a></div>
\t\t\t\t\t\t\t\t\t<div class=\"clear\"></div>
                </div>
            </div>
        </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 28
        echo "</ul>
";
    }

    public function getTemplateName()
    {
        return "productOptions.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
