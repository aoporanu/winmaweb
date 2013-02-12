<?php

/* error404.twig */
class __TwigTemplate_9fe972040445310b4152f90e03b43eb7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
            'main_menu' => array($this, 'block_main_menu'),
            'content_page' => array($this, 'block_content_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getAttribute($this->getContext($context, "app"), "ajax")) ? ("layouts/ajax.twig") : ("layouts/layout_default.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_page_title($context, array $blocks = array())
    {
        echo "404 page not found :: DailyDeals";
    }

    // line 5
    public function block_main_menu($context, array $blocks = array())
    {
        // line 6
        echo "<div class=\"main_menu_container\">
    <ul class=\"main_menu\">
        <li><a href=\"/\">Today's Deal</a></li>
        <li><a href=\"/all-deals\">All Deals</a></li>
        <li><a href=\"/recent-deals\">Recent Deals</a></li>
    </ul>
</div>
";
    }

    // line 15
    public function block_content_page($context, array $blocks = array())
    {
        // line 16
        echo "Sorry, we can't find what you are looking for!
";
    }

    public function getTemplateName()
    {
        return "error404.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
