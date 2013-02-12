<?php

/* layouts/ajax.twig */
class __TwigTemplate_95734eabdb1563441eb720914a5cf97b extends Twig_Template
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
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('content_page', $context, $blocks);
    }

    public function block_content_page($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layouts/ajax.twig";
    }

    public function isTraitable()
    {
        return true;
    }
}
