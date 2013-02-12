<?php

/* merchant/show.twig */
class __TwigTemplate_700e8bde3e6be91c5fad0bacc7339579 extends Twig_Template
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
        return $this->env->resolveTemplate((($this->getAttribute($this->getContext($context, "app"), "ajax")) ? ("layouts/ajax.twig") : ("layouts/layout.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div style=\"float: left;\">
<h1>Merchant requests <a href=\"";
        // line 5
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageMerchants?ac=activation", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["activation"])) { $_activation_ = $context["activation"]; } else { $_activation_ = null; }
        if (($_activation_ == "on")) {
            echo "g-button-share";
        } else {
            echo "g-button-red";
        }
        echo " ajax-link-nourl\">";
        if (isset($context["activation"])) { $_activation_ = $context["activation"]; } else { $_activation_ = null; }
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $_activation_), "html", null, true);
        echo "</a></h1>
</div>
";
        // line 10
        echo "<div style=\"clear: both;\"></div>
    <a href=\"";
        // line 11
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageMerchants", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["activeMenu"])) { $_activeMenu_ = $context["activeMenu"]; } else { $_activeMenu_ = null; }
        if (($_activeMenu_ == "")) {
            echo " g-button-share";
        }
        echo " ajax-link\">Merchants</a>
    <a href=\"";
        // line 12
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageMerchants?show=request", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["activeMenu"])) { $_activeMenu_ = $context["activeMenu"]; } else { $_activeMenu_ = null; }
        if (($_activeMenu_ == "request")) {
            echo " g-button-share";
        }
        echo " ajax-link\">Merchant Requests</a>
";
        // line 14
        echo "    <a href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageMerchants?show=agents", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["activeMenu"])) { $_activeMenu_ = $context["activeMenu"]; } else { $_activeMenu_ = null; }
        if (($_activeMenu_ == "agents")) {
            echo " g-button-share";
        }
        echo " ajax-link\">Agents</a>
\t\t<ul class=\"pagination clearfix\">";
        // line 15
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"width: 100%\">
        <tr class=\"th-class alt-row\">
            ";
        // line 19
        echo "            <th style=\"width: 300px;\"><a class=\"href-link \" href=\"#\">username</a></th>
            <th style=\"width: 300px;\"><a class=\"href-link \" href=\"#\">email</a></th>
            <th align=\"center\" style=\"width: 60px;\">action</th>
        </tr>
    ";
        // line 23
        if (isset($context["users"])) { $_users_ = $context["users"]; } else { $_users_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_users_);
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 24
            echo "        <tr";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ((0 == $this->getAttribute($_loop_, "index") % 2)) {
                echo " class=\"tr-even\"";
            } else {
                echo " class=\"tr-odd\"";
            }
            echo ">
            <td style=\"padding:5px;\">";
            // line 25
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_user_, "username"), "html", null, true);
            echo "</td>
            <td style=\"padding:5px;\">";
            // line 26
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_user_, "email"), "html", null, true);
            echo "</td>
            <td style=\"padding:5px;\"><a href=\"";
            // line 27
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageUsersActions?id=" . $this->getAttribute($_user_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-share modal-user g-button-small\" title=\"";
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_user_, "username"), "html", null, true);
            echo " actions\">actions</a></td>
        </tr>
    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 30
        echo "    </table>
    <ul class=\"pagination clearfix\">";
        // line 31
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
";
    }

    // line 33
    public function block_left_menu($context, array $blocks = array())
    {
        // line 34
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 35
            echo "        ";
            $context["adm_menu"] = "merchants";
            // line 36
            echo "        ";
            $this->env->loadTemplate("inc/leftSide.twig")->display($context);
            // line 37
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "merchant/show.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
