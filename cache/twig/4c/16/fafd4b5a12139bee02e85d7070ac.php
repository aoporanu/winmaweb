<?php

/* /default/add.twig */
class __TwigTemplate_4c16fafd4b5a12139bee02e85d7070ac extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'left_menu' => array($this, 'block_left_menu'),
        );
    }

    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
        if ($_message_) {
            // line 3
            if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
            echo twig_escape_filter($this->env, $_message_, "html", null, true);
            echo "
";
        }
        // line 5
        $this->displayBlock('content', $context, $blocks);
        // line 50
        $this->displayBlock('left_menu', $context, $blocks);
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<div style=\"text-align:right\">
        <a href=\"";
        // line 7
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myNetwork?add", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if ((!$_view_)) {
            echo " g-button-submit";
        }
        echo " ajax-link\">Add Media</a>
        <a href=\"";
        // line 8
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageTransactions?view=accepted", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "accepted")) {
            echo " g-button-submit";
        }
        echo " ajax-link\">Accepted</a>
        <a href=\"";
        // line 9
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageTransactions?view=rejected", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "rejected")) {
            echo " g-button-submit";
        }
        echo " ajax-link\">Rejected</a></div>
    <br />
";
        // line 11
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 12
            echo "\t<div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong>
\t\t";
            // line 13
            if (isset($context["err_img"])) { $_err_img_ = $context["err_img"]; } else { $_err_img_ = null; }
            if ($_err_img_) {
                echo "<br />";
                if (isset($context["err_img"])) { $_err_img_ = $context["err_img"]; } else { $_err_img_ = null; }
                echo twig_escape_filter($this->env, $_err_img_, "html", null, true);
            }
            // line 14
            echo "\t</div>
";
        }
        // line 16
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 17
            echo "\t<div class=\"infotip\"><strong>Success</strong><br /><br />Product added successfully<br /><a class=\"modal-close\" href=\"#\">Close</a></div>
";
        } else {
            // line 19
            echo "<form enctype=\"multipart/form-data\" action=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myProductsAdd", ), "method"), "html", null, true);
            echo "\" method=\"post\" name=\"myForm\">
\t<div class=\"form-global clearfix\">
\t\t<div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"name\">Name of Media File:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 24
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("name", $this->getAttribute($this->getAttribute($_form_, "values"), "title"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 25
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "title"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
        <div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"name\">File Name:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 31
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("name", $this->getAttribute($this->getAttribute($_form_, "values"), "file_name"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 32
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "file_name"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
        <div class=\"clearfix\">
\t\t\t<div class=\" label label_big\"><label for=\"name\">File:</label></div>
\t\t\t<div class=\"input\">
\t\t\t\t";
            // line 38
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("name", $this->getAttribute($this->getAttribute($_form_, "values"), "photo123"), ), "method"), "html", null, true);
            echo "
\t\t\t\t";
            // line 39
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "photo123"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
        <div class=\"form-global clearfix\">
            <div class=\" label label_big\"><label>&nbsp;</label></div>
            <div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit modal-submit-product\" value=\"Add\" /></div>
        </div>
    </div>
</form>
";
        }
    }

    // line 50
    public function block_left_menu($context, array $blocks = array())
    {
        // line 51
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 52
            echo "        ";
            $context["adm_menu"] = "my_network";
            // line 53
            echo "        ";
            $this->env->loadTemplate("inc/leftSide.twig")->display($context);
            // line 54
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "/default/add.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
