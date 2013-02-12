<?php

/* inc/productList.twig */
class __TwigTemplate_c23b676343eb1f21ea9a3cc76beef4de extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "\t<div class=\"blog-small\">
\t\t<div class=\"title-blog-small\"><a href=\"/";
        // line 2
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
        echo "/";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
        echo ".html\">";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "name"), "html", null, true);
        echo "</a></div><!--/title-blog-small-->
\t\t<div class=\"images-small\">
\t\t\t<a href=\"/";
        // line 4
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
        echo "/";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
        echo ".html\" class=\"pirobox \" title=\"\" rel=\"single\">
\t\t\t\t";
        // line 5
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if ($this->getAttribute($_product_, "ProductMedia")) {
            // line 6
            echo "\t\t\t\t\t<img src=\"";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductMedia"), 0), "dir"), "html", null, true);
            echo "/thumb250x156/";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductMedia"), 0), "file_name"), "html", null, true);
            echo "_";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductMedia"), 0), "id"), "html", null, true);
            echo ".";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductMedia"), 0), "ext"), "html", null, true);
            echo "\" width=\"250\" height=\"156\" />
        ";
        }
        // line 8
        echo "\t\t\t</a>
\t\t\t<div class=\"statistic\">
\t\t\t\t\t<ul>
\t\t\t\t\t\t\t<li>Deal Value<p>";
        // line 11
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "suplier_price")), "html", null, true);
        echo "</p></li>
\t\t\t\t\t\t\t<li class=\"statistic-border\"></li>
\t\t\t\t\t\t\t<li>Discount<p>";
        // line 13
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "discount"), "html", null, true);
        echo "%</p></li>
\t\t\t\t\t\t\t<li class=\"statistic-border\"></li>
\t\t\t\t\t\t\t<li>Price<p>";
        // line 15
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "price")), "html", null, true);
        echo "</p></li>
\t\t\t\t\t</ul>
\t\t\t</div><!--statistic-->
\t\t</div><!--/images-small-->
\t\t<div class=\"blog-small-button\" style=\"width:285px\">
\t\t\t<script type=\"text/javascript\">
\t\t\t";
        // line 24
        echo "\t\t\t</script>
                        <div class=\"left\" style=\"width:25px;color:#8C8B8C;margin-top:-10px;\">Deal Ends In</div><div class=\"timer_content left\">";
        // line 25
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_product_, "endtime"), "Y/m/d H:i"), "html", null, true);
        echo "</div>
\t\t\t\t<div class=\"small-button\">
\t\t\t\t\t<a href=\"/";
        // line 27
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
        echo "/";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
        echo ".html\">
\t\t\t\t\t\t<div class=\"button_see\">
\t\t\t\t\t\t\t<div class=\"small-left\"></div>
\t\t\t\t\t\t\t<div class=\"small-center\">SEE DEAL</div>
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
        return "inc/productList.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
