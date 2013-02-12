<?php

/* user/actionsEdit.twig */
class __TwigTemplate_431f84e07f3da83e082e93745eaa607a extends Twig_Template
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
        // line 2
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        $context["actionsMenu"] = "edit";
        // line 6
        $this->env->loadTemplate("user/actionsMenu.twig")->display($context);
        // line 7
        echo "
<div style=\"padding-top:20px;\">
    ";
        // line 9
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 10
            echo "        <br /><div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
    ";
        }
        // line 12
        echo "    ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 13
            echo "        <div class=\"infotip\"><strong>Success</strong><br /><br />Details were updated successfully</div>
    ";
        }
        // line 15
        echo "    <form enctype=\"application/x-www-form-urlencoded\" action=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=edit"), ), "method"), "html", null, true);
        echo "\" method=\"post\">
        <div class=\"form-global clearfix\">
            <div class=\"label\"><label for=\"first_name\">First name:</label></div>
            <div class=\"input input_big\">
                ";
        // line 19
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("first_name", $this->getAttribute($this->getAttribute($_form_, "values"), "first_name"), ), "method"), "html", null, true);
        echo "
                ";
        // line 20
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "first_name"), ), "method"), "html", null, true);
        echo "
            </div>
            <div class=\"label\"><label for=\"last_name\">Last name:</label></div>
            <div class=\"input input_big\">
                ";
        // line 24
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("last_name", $this->getAttribute($this->getAttribute($_form_, "values"), "last_name"), ), "method"), "html", null, true);
        echo "
                ";
        // line 25
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "last_name"), ), "method"), "html", null, true);
        echo "
            </div>
            <div class=\"label\"><label for=\"phone\">Phone:</label></div>
            <div class=\"input input_big\">
                ";
        // line 29
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("phone", $this->getAttribute($this->getAttribute($_form_, "values"), "phone"), ), "method"), "html", null, true);
        echo "
                ";
        // line 30
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "phone"), ), "method"), "html", null, true);
        echo "
            </div>
            <div class=\"label\"><label for=\"email\">Email:</label></div>
            <div class=\"input input_big\">
                ";
        // line 34
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("email", $this->getAttribute($this->getAttribute($_form_, "values"), "email"), ), "method"), "html", null, true);
        echo "
                ";
        // line 35
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "email"), ), "method"), "html", null, true);
        echo "
            </div>
        </div>
        <div class=\"page_subtitle_wrapper clearfix\">
            <span class=\"page_subtitle_two\" style=\"background-color:#fff;\">Address</span>
        </div>
            <div class=\"form-global clearfix\">
                <div class=\"label\"><label for=\"address\">Address:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 44
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("address", $this->getAttribute($this->getAttribute($_form_, "values"), "address"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 45
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "address"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"city\">City:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 49
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("city", $this->getAttribute($this->getAttribute($_form_, "values"), "city"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 50
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "city"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"county\">County:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 54
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("county", $this->getAttribute($this->getAttribute($_form_, "values"), "county"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 55
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "county"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"postcode\">Postal code:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 59
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("postcode", $this->getAttribute($this->getAttribute($_form_, "values"), "postcode"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 60
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "postcode"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"country\">Country:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 64
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("country", $this->getAttribute($this->getAttribute($_form_, "countries"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "country"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 65
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "country"), ), "method"), "html", null, true);
        echo "
                </div>
            </div>
            <div class=\"page_subtitle_wrapper clearfix\">
                <span class=\"page_subtitle_two\" style=\"background-color:#fff;\">Bank Details</span>
            </div>
            <div class=\"form-global clearfix\">
                <div class=\"label\"><label for=\"beneficiary_name\">Beneficiary Name:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 74
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("beneficiary_name", $this->getAttribute($this->getAttribute($_form_, "values"), "beneficiary_name"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 75
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "beneficiary_name"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_code\">Bank Code:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 79
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_code", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_code"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 80
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_code"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_branch_code\">Bank Branch Code:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 84
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_branch_code", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_branch_code"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 85
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_branch_code"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_account_number\">Bank Account Number:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 89
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_account_number", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_account_number"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 90
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_account_number"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_name\">Bank Name:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 94
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("bank_name", $this->getAttribute($this->getAttribute($_form_, "kkt"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "bank_name"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 95
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_name"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_address\">Bank Address:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 99
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_address", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_address"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 100
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_address"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label>&nbsp;</label></div>
                <div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit modal-ajax-submit\" value=\"Change\" /></div>
            </div>
    </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "user/actionsEdit.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
