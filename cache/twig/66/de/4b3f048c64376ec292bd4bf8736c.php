<?php

/* default/add.twig */
class __TwigTemplate_66de4b3f048c64376ec292bd4bf8736c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getAttribute($this->getContext($context, "app"), "ajax")) ? ("layouts/ajax.twig") : ("layouts/layout.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 7
            echo "\t<div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong>
\t\t";
            // line 8
            if (isset($context["err_img"])) { $_err_img_ = $context["err_img"]; } else { $_err_img_ = null; }
            if ($_err_img_) {
                echo "<br />";
                if (isset($context["err_img"])) { $_err_img_ = $context["err_img"]; } else { $_err_img_ = null; }
                echo twig_escape_filter($this->env, $_err_img_, "html", null, true);
            }
            // line 9
            echo "\t</div>
";
        }
        // line 11
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 12
            echo "\t<div class=\"infotip\"><strong>Success</strong><br /><br />Product added successfully<br /><a class=\"modal-close\" href=\"#\">Close</a></div>
";
        } else {
            // line 14
            echo "<form enctype=\"multipart/form-data\" action=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myNetwork?ac=add", ), "method"), "html", null, true);
            echo "\" method=\"post\" name=\"myForm\">
\t<div class=\"form-global clearfix\">
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"name\">Title:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 19
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("title", $this->getAttribute($this->getAttribute($_form_, "values"), "title"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 20
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "title"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
    <div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"name\">File:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t<input name=\"file\" type=\"file\" id=\"file\" />
\t\t\t\t";
            // line 27
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "file"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
        <div class=\"form-global clearfix\">
            <div class=\" label label_big\"><label>&nbsp;</label></div>
            <div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit\" value=\"Add\" /></div>
        </div>
    </div>
</form>
";
        }
    }

    public function getTemplateName()
    {
        return "default/add.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
