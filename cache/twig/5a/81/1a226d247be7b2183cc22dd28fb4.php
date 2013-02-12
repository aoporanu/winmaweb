<?php

/* myaccount/addPhoto.twig */
class __TwigTemplate_5a811a226d247be7b2183cc22dd28fb4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'css' => array($this, 'block_css'),
            'js' => array($this, 'block_js'),
            'content_page' => array($this, 'block_content_page'),
            'right_side' => array($this, 'block_right_side'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getAttribute($this->getContext($context, "app"), "ajax")) ? ("layouts/ajax.twig") : ("layouts/layout.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_css($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 6
            echo "        ";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 7
            echo "    ";
        }
    }

    // line 9
    public function block_js($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 11
            echo "        ";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 12
            echo "    ";
        }
    }

    // line 15
    public function block_content_page($context, array $blocks = array())
    {
        // line 16
        echo "<h1>Add Photo</h1>
    <div class=\"ma_top\"></div>
    <div class=\"ma_content\">
        <br />
        <div class=\"info-blue\">
            <p>You may pick any photo.  Your photo will automatically be resized and fitted to the website.</p>
        </div><br /><br />
";
        // line 23
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 24
            echo "    <div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
";
        }
        // line 26
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 27
            echo "    <div class=\"infotip\"><strong>Success</strong><br /><br />Image added successfully</div>
";
        }
        // line 29
        echo "<div class=\"clearfix\">
";
        // line 30
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_user_, "UserMedia"));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
            // line 31
            echo "    <div style=\"width:120px;height:90px;margin:10px;\" class=\"left\">
        <img src=\"";
            // line 32
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "dir"), "html", null, true);
            echo "/thumb120x67/";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "file_name"), "html", null, true);
            echo "_";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "id"), "html", null, true);
            echo ".";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "ext"), "html", null, true);
            echo "\" width=\"120\" height=\"67\" style=\"border:2px solid ";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            if (($this->getAttribute($_image_, "main") == 1)) {
                echo "red";
            } else {
                echo "#cacaca";
            }
            echo ";padding:1px;\" />
        <a href=\"";
            // line 33
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(((("@myAccountEdit?id=" . $this->getAttribute($_user_, "id")) . "&ac=photo&m=delete&pic_id=") . $this->getAttribute($_image_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"modal-ajax-link g-button g-button-submit\">Delete</a>
    </div>
";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 36
            echo "        <form enctype=\"multipart/form-data\" action=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountEdit?ac=photo", ), "method"), "html", null, true);
            echo "\" method=\"post\">
            <div class=\"form-global clearfix\">
                <input type='hidden' name='isajaxrequest' id='isajaxrequest' value='0' />
                <div class=\"label\"><label for=\"photo\">Photo:</label></div>
                <div class=\"input input_big\">
                    <input name=\"photo\" type=\"file\" id=\"photo\" />
                    ";
            // line 42
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "photo"), ), "method"), "html", null, true);
            echo "
                </div>
            </div>
            <div class=\"form-global clearfix\">
                <div class=\"label\"><label>&nbsp;</label></div>
                <div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit\" value=\"Add\" /></div>
            </div>
        </form>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 51
        echo "</div>
        <br />
</div>
<div class=\"ma_bottom\"></div>
";
    }

    // line 57
    public function block_right_side($context, array $blocks = array())
    {
        // line 58
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 59
            echo "        ";
            $context["ma_menu"] = "photo";
            // line 60
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 61
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/addPhoto.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
