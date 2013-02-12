<?php

/* commission/editLevel.twig */
class __TwigTemplate_3792002676e6ba83660142510f32ce5c extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        // line 2
        echo "
";
        // line 3
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 4
            echo "    <br /><div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
";
        }
        // line 6
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 7
            echo "<div class=\"infotip\"><strong>Success</strong><br /><br />Level modified successfully</div>
";
        }
        // line 9
        echo "<form enctype=\"application/x-www-form-urlencoded\" action=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["levelId"])) { $_levelId_ = $context["levelId"]; } else { $_levelId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageCommissions?ac=edit_level&id=" . $_levelId_), ), "method"), "html", null, true);
        echo "\" method=\"post\">
    <div class=\"form-global clearfix\">
        <div class=\"label\"><label for=\"commission\">Commission:</label></div>
        <div class=\"input input_big\">
            ";
        // line 13
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("commission", $this->getAttribute($this->getAttribute($_form_, "values"), "commission"), ), "method"), "html", null, true);
        echo "
            ";
        // line 14
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "commission"), ), "method"), "html", null, true);
        echo "
        </div>
    </div>
    <div class=\"form-global clearfix\">
        <div class=\"label\"><label>&nbsp;</label></div>
        <div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit modal-ajax-submit\" value=\"Edit\" /></div>
    </div>
</form>

";
    }

    public function getTemplateName()
    {
        return "commission/editLevel.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
