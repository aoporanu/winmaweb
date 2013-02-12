<?php

/* myaccount/removeFriend.twig */
class __TwigTemplate_69cf74df4ac7fe9668f02d96751cef1b extends Twig_Template
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
        // line 2
        if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
        echo twig_escape_filter($this->env, $_message_, "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "myaccount/removeFriend.twig";
    }

    public function isTraitable()
    {
        return true;
    }
}
