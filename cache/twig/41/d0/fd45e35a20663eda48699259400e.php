<?php

/* right_side.twig */
class __TwigTemplate_41d0fd45e35a20663eda48699259400e extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"search_container\">
\t<form name=\"frmSearch\" class=\"search-form\" method=\"get\" action=\"/search\" enctype=\"application/x-www-form-urlencoded\">
\t\t";
        // line 3
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("term", "", ), "method"), "html", null, true);
        echo "
\t\t<input class=\"search_button\" type=\"submit\" value=\"Search\" />
\t</form>
</div>

<div class=\"right-box-top\">
\t<div style=\"color:#fff;font-size: 16px\">Other deals</div>
</div>
<div class=\"right-box-content\">
\t<div>
\t\t<ul>
\t\t\t";
        // line 14
        if (isset($context["other"])) { $_other_ = $context["other"]; } else { $_other_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_other_);
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 15
            echo "\t\t\t\t<li style=\"padding:10px 5px;border-bottom:1px solid #cacaca\">
\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t<a href=\"/";
            // line 17
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
            echo "/";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
            echo ".html\"><img style=\"vertical-align: middle;\" src=\"/images/site/price_tag_view.png\" alt=\"Price_tag_view\" /></a>
\t\t\t\t\t\t<a href=\"/";
            // line 18
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
            echo "/";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
            echo ".html\">";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "name"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t";
            // line 19
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "sold") > 0)) {
                echo "<div style=\"padding-left:20px;padding-top:10px;line-height:20px;height:20px\"><img style=\"vertical-align: middle;\" width=\"17\" height=\"18\" title=\"\" src=\"/images/site/check_mark.png\" alt=\"\" /> ";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_product_, "sold"), "html", null, true);
                echo " bought</div>";
            }
            // line 20
            echo "\t\t\t\t\t</div>
\t\t\t\t</li>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 23
        echo "\t\t</ul>
\t\t&nbsp;
\t</div>
</div>
<div class=\"right-box-bottom\">&nbsp;</div>

<div class=\"right-box-top\">
\t<div style=\"color:#fff;font-size: 16px\">Watch Us</div>
</div>

<div class=\"right-box-content\">
\t<div style=\"text-align:center\">
\t\t<a href=\"https://www.youtube.com/watch?v=pMCPHVjKQdE\" rel=\"prettyPhoto\" title=\"\"><img src=\"/images/default.jpg\" alt=\"WinMaWeb\" width=\"240\" /></a>
\t</div>
</div>
<div class=\"right-box-bottom\">&nbsp;</div>

<div class=\"right-box-top\">
\t<div style=\"color:#fff;font-size: 16px\">Tags</div>
</div>
<div class=\"right-box-content\">
\t<div class=\"tagcloud\">
\t\t";
        // line 45
        $context["max"] = 0;
        // line 46
        echo "\t\t";
        $context["min"] = 1;
        // line 47
        echo "\t\t";
        if (isset($context["tags"])) { $_tags_ = $context["tags"]; } else { $_tags_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_tags_);
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 48
            echo "\t\t\t";
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            if (isset($context["max"])) { $_max_ = $context["max"]; } else { $_max_ = null; }
            if (($this->getAttribute($_tag_, "nr") > $_max_)) {
                // line 49
                echo "\t\t\t";
                if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
                $context["max"] = $this->getAttribute($_tag_, "nr");
                // line 50
                echo "\t\t\t";
            }
            // line 51
            echo "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 52
        echo "\t\t";
        if (isset($context["tags"])) { $_tags_ = $context["tags"]; } else { $_tags_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_tags_);
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 53
            echo "\t\t\t";
            if (isset($context["max"])) { $_max_ = $context["max"]; } else { $_max_ = null; }
            if (isset($context["min"])) { $_min_ = $context["min"]; } else { $_min_ = null; }
            $context["size"] = ($_max_ - $_min_);
            // line 54
            echo "\t\t\t";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            if (($_size_ == 0)) {
                // line 55
                echo "\t\t\t";
                $context["size"] = 1;
                // line 56
                echo "\t\t\t";
            }
            // line 57
            echo "\t\t\t";
            if (isset($context["max"])) { $_max_ = $context["max"]; } else { $_max_ = null; }
            if (($_max_ < 5)) {
                // line 58
                echo "\t\t\t";
                if (isset($context["max"])) { $_max_ = $context["max"]; } else { $_max_ = null; }
                if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
                $context["size"] = ((14 / (5 - $_max_)) / $_size_);
                // line 59
                echo "\t\t\t";
            } else {
                // line 60
                echo "\t\t\t";
                if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
                $context["size"] = (14 / $_size_);
                // line 61
                echo "\t\t\t";
            }
            // line 62
            echo "\t\t\t";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            if (isset($context["min"])) { $_min_ = $context["min"]; } else { $_min_ = null; }
            $context["size"] = (8 + ($_size_ * ($this->getAttribute($_tag_, "nr") - $_min_)));
            // line 63
            echo "\t\t\t<a href=\"/tag/";
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_tag_, "name"), "html", null, true);
            echo "\" style=\"font-size: ";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo twig_escape_filter($this->env, $_size_, "html", null, true);
            echo "pt;\">";
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_tag_, "name"), "html", null, true);
            echo "</a>&nbsp;&nbsp;&nbsp;
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 65
        echo "\t</div>
</div>
<div class=\"right-box-bottom\">&nbsp;</div>";
    }

    public function getTemplateName()
    {
        return "right_side.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
