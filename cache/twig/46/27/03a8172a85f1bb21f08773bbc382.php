<?php

/* myaccount/editaccount.twig */
class __TwigTemplate_462703a8172a85f1bb21f08773bbc382 extends Twig_Template
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

    // line 14
    public function block_content_page($context, array $blocks = array())
    {
        // line 15
        echo "    <h1>Edit Account</h1>
    <div class=\"ma_top\"></div>
    <div class=\"ma_content\">
        <div class=\"info-blue\">
            <p>In the Edit Account Section you may change your personal information. 
                <br />
                Please Note:  This information is never visible to other members.</p>
        </div><br /><br />
        ";
        // line 23
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 24
            echo "            <br /><div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
        ";
        }
        // line 26
        echo "        ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 27
            echo "            <div class=\"infotip\"><strong>Success</strong><br /><br />Details were updated successfully</div>
        ";
        }
        // line 29
        echo "        <form enctype=\"application/x-www-form-urlencoded\" action=\"/my-account/edit-account\" method=\"post\">
            <div class=\"form-global clearfix\">
\t\t\t\t\t\t\t<div class=\"label\"><label for=\"is_private\">Make Private</label></div>
\t\t\t\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"is_private\" id=\"is_private\" style=\"width: 20px; margin-top: 5px;\" ";
        // line 33
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($this->getAttribute($_app_, "user"), "is_private")) {
            echo " checked ";
        }
        echo " value=\"1\" />
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t</div>
                <div class=\"label\"><label for=\"first_name\">First Name:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 38
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("first_name", $this->getAttribute($this->getAttribute($_form_, "values"), "first_name"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 39
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "first_name"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"last_name\">Last Name:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 43
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("last_name", $this->getAttribute($this->getAttribute($_form_, "values"), "last_name"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 44
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "last_name"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"phone\">Phone:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 48
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("phone", $this->getAttribute($this->getAttribute($_form_, "values"), "phone"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 49
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "phone"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"email\">E-mail:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 53
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("email", $this->getAttribute($this->getAttribute($_form_, "values"), "email"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 54
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "email"), ), "method"), "html", null, true);
        echo "
                </div>
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"gender\">Gender:</label></div>
\t\t\t\t\t\t\t\t<div class=\"input input_big\">
                    ";
        // line 58
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("gender", $this->getAttribute($this->getAttribute($_form_, "gender"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "gender"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 59
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "gender"), ), "method"), "html", null, true);
        echo "
                </div>
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"age\">Age:</label></div>
\t\t\t\t\t\t\t\t<div class=\"input input_big\">
                    ";
        // line 64
        echo "\t\t\t\t\t\t\t\t\t\t";
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("age", $this->getAttribute($this->getAttribute($_form_, "age"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "age"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 65
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "age"), ), "method"), "html", null, true);
        echo "
                </div>
            </div>
            <div class=\"page_subtitle_wrapper clearfix\">
                <span class=\"page_subtitle_two\">Address</span>
            </div>
            <div class=\"form-global clearfix\">
                <div class=\"label\"><label for=\"address\">Address:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 74
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("address", $this->getAttribute($this->getAttribute($_form_, "values"), "address"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 75
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "address"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"city\">City:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 79
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("city", $this->getAttribute($this->getAttribute($_form_, "values"), "city"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 80
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "city"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"county\">Province/County:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 84
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("county", $this->getAttribute($this->getAttribute($_form_, "values"), "county"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 85
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "county"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"postcode\">Postal Code:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 89
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("postcode", $this->getAttribute($this->getAttribute($_form_, "values"), "postcode"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 90
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "postcode"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"country\">Country:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 94
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("country", $this->getAttribute($this->getAttribute($_form_, "countries"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "country"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 95
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "country"), ), "method"), "html", null, true);
        echo "
                </div>
            </div>
            <div class=\"page_subtitle_wrapper clearfix\">
                <span class=\"page_subtitle_two\">Bank Details</span>
            </div>
            <div class=\"form-global clearfix\">
                <div class=\"label\"><label for=\"beneficiary_name\">Beneficiary Name:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 104
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("beneficiary_name", $this->getAttribute($this->getAttribute($_form_, "values"), "beneficiary_name"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 105
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "beneficiary_name"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_code\">Bank Code:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 109
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_code", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_code"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 110
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_code"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_branch_code\">Bank Branch Code:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 114
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_branch_code", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_branch_code"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 115
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_branch_code"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_account_number\">Bank Account Number:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 119
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_account_number", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_account_number"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 120
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_account_number"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_name\">Bank Name:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 124
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("bank_name", $this->getAttribute($this->getAttribute($_form_, "kkt"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "bank_name"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 125
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_name"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_address\">Bank Address:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 129
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_address", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_address"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 130
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_address"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label>&nbsp;</label></div>
                <div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit ajax-submit\" value=\"Change\" /></div>
            </div>
        </form>
    </div>
    <div class=\"ma_bottom\"></div>
";
    }

    // line 140
    public function block_right_side($context, array $blocks = array())
    {
        // line 141
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 142
            echo "        ";
            $context["ma_menu"] = "editAccount";
            // line 143
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 144
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/editaccount.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
