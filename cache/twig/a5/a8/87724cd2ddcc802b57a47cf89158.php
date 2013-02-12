<?php

/* myaccount/products/prices.twig */
class __TwigTemplate_a5a887724cd2ddcc802b57a47cf89158 extends Twig_Template
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
        echo "<ul>
    ";
        // line 5
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_product_, "ProductPrice"));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["price"]) {
            // line 6
            echo "    <li style=\"padding:10px;border-bottom:1px solid #cacaca\">
        <div style=\"font-weight:bold;padding:5px;\">&bull; Name: ";
            // line 7
            if (isset($context["price"])) { $_price_ = $context["price"]; } else { $_price_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_price_, "name"), "html", null, true);
            echo "</div>
        <div style=\"padding:5px;\">&bull; Price: ";
            // line 8
            if (isset($context["price"])) { $_price_ = $context["price"]; } else { $_price_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_price_, "price"), "html", null, true);
            echo "\$</div>
        <div style=\"padding:5px;\">&bull; Suplier Price: ";
            // line 9
            if (isset($context["price"])) { $_price_ = $context["price"]; } else { $_price_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_price_, "suplier_price"), "html", null, true);
            echo "\$</div>
        <div style=\"padding:5px;\">&bull; Discount: ";
            // line 10
            if (isset($context["price"])) { $_price_ = $context["price"]; } else { $_price_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_price_, "discount"), "html", null, true);
            echo "%</div>
        <div style=\"padding:5px;\">&bull; Money save: ";
            // line 11
            if (isset($context["price"])) { $_price_ = $context["price"]; } else { $_price_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_price_, "money_save"), "html", null, true);
            echo "\$</div>
        <div style=\"padding:5px;\">&bull; Sold: ";
            // line 12
            if (isset($context["price"])) { $_price_ = $context["price"]; } else { $_price_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_price_, "sold"), "html", null, true);
            echo "</div>
        <div style=\"padding:5px;\">&bull; Stock: ";
            // line 13
            if (isset($context["price"])) { $_price_ = $context["price"]; } else { $_price_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_price_, "stock"), "html", null, true);
            echo "</div>
    </li>
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 16
            echo "    <li>No price</li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['price'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 18
        echo "</ul>
";
    }

    public function getTemplateName()
    {
        return "myaccount/products/prices.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
