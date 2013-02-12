<?php

/* inc/charityList.twig */
class __TwigTemplate_5ed76c5b87282e8b2776f59c07d428bb extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "\t<div class=\"blog-small\">
\t\t<div class=\"title-blog-small\"><a href=\"/charity/";
        // line 2
        if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_charity_, "slug"), "html", null, true);
        echo ".html\">";
        if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_charity_, "name"), "html", null, true);
        echo "</a></div><!--/title-blog-small-->
\t\t<div class=\"images-small\">
\t\t\t<a href=\"/charity/";
        // line 4
        if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_charity_, "slug"), "html", null, true);
        echo ".html\" class=\"pirobox \" title=\"\" rel=\"single\">
\t\t\t\t";
        // line 5
        if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
        if ($this->getAttribute($_charity_, "CharityMedia")) {
            // line 6
            echo "\t\t\t\t\t<img src=\"";
            if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_charity_, "CharityMedia"), 0), "dir"), "html", null, true);
            echo "/thumb250x156/";
            if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_charity_, "CharityMedia"), 0), "file_name"), "html", null, true);
            echo "_";
            if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_charity_, "CharityMedia"), 0), "id"), "html", null, true);
            echo ".";
            if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_charity_, "CharityMedia"), 0), "ext"), "html", null, true);
            echo "\" width=\"250\" height=\"156\" />
        ";
        }
        // line 8
        echo "\t\t\t</a>
\t\t\t<div class=\"statistic\">
\t\t\t</div><!--statistic-->
\t\t</div><!--/images-small-->
\t\t<div class=\"blog-small-button\">
\t\t\t<script type=\"text/javascript\">
\t\t\t";
        // line 17
        echo "\t\t\t</script>
\t\t\t<div class=\"\"></div>
\t\t\t\t<div class=\"small-button\">
\t\t\t\t\t<a href=\"/charity/";
        // line 20
        if (isset($context["charity"])) { $_charity_ = $context["charity"]; } else { $_charity_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_charity_, "slug"), "html", null, true);
        echo ".html\">
\t\t\t\t\t\t<div class=\"button_see\">
\t\t\t\t\t\t\t<div class=\"small-left\"></div>
\t\t\t\t\t\t\t<div class=\"small-center\">SEE CHARITY</div>
\t\t\t\t\t\t\t<div class=\"small-right\"></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</a><!--/button-->
\t\t\t\t</div><!--/small-button-->
\t\t</div><!--/blog-small-button-->
\t</div><!--/blog-small-->
\t
\t
\t";
    }

    public function getTemplateName()
    {
        return "inc/charityList.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
