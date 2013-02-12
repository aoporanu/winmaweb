<?php

/* layouts/layout.twig */
class __TwigTemplate_9d5220b8daf2ba095eb43a91d450e0a5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
            'seo' => array($this, 'block_seo'),
            'css' => array($this, 'block_css'),
            'js' => array($this, 'block_js'),
            'left_menu' => array($this, 'block_left_menu'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<head>
    <title>";
        // line 4
        $this->displayBlock('page_title', $context, $blocks);
        echo "</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    ";
        // line 6
        $this->displayBlock('seo', $context, $blocks);
        // line 10
        echo "    <meta name=\"robots\" content=\"INDEX,FOLLOW\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/global.css\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/ui-lightness/jquery-ui-1.8.16.custom.css\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/timepicker.css\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/jquery.tagsinput.css\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/admin/style.css\" />
    ";
        // line 16
        $this->displayBlock('css', $context, $blocks);
        // line 18
        echo "    <script type=\"text/javascript\" src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"/js/jquery.form.js\"></script>
    <script type=\"text/javascript\" src=\"/js/jquery.scrollTo-1.4.2-min.js\"></script>
    <script type=\"text/javascript\" src=\"/js/jquery.modal.js\"></script>
    <script type=\"text/javascript\" src=\"/js/jquery-ui-1.8.16.custom.min.js\"></script>
    <script type=\"text/javascript\" src=\"/js/jquery.timepicker.js\"></script>
    <script type=\"text/javascript\" src=\"/js/jquery.tagsinput.js\"></script>
    <script type=\"text/javascript\" src=\"/tiny_mce/jquery.tinymce.js\"></script>
    <script type=\"text/javascript\" src=\"/js/highcharts.js\"></script>
    <script src=\"/js/modules/exporting.js\" type=\"text/javascript\"></script>
    <script src=\"/js/global.js\" type=\"text/javascript\"></script>
    ";
        // line 29
        $this->displayBlock('js', $context, $blocks);
        // line 31
        echo "    <script type=\"text/javascript\" src=\"/js/admin.js\"></script>
    <script type=\"text/javascript\">
        \$('a[href=\"/admin/users/actions/8?tab=edit\"]').click(function() {
            \$('.container').css('height', '841px');
        });
    </script>
</head>
<body>
    <div id=\"modal-popup\" class=\"modal-popup\">
        <div class=\"modal-overlay\"></div>
        <div class=\"modal-fix\">
            <div class=\"modal-container\">
                <div class=\"modal-bg\">

                    <div class=\"context-loader\">Please wait</div>

                </div>
            </div>
        </div>
    </div>
    <div class=\"container\">
        <div class=\"yui3-g\">
            <div class=\"yui3-u\">
                <div class=\"left-menu\">
                ";
        // line 55
        $this->displayBlock('left_menu', $context, $blocks);
        // line 111
        echo "                </div>
            </div>
            <div class=\"yui3-u\">
                <div class=\"content\" id=\"ajax-content\">
                    ";
        // line 115
        $this->displayBlock('content', $context, $blocks);
        // line 116
        echo "                </div>
            </div>
        </div>
        <div id=\"footer\"></div>
    </div>
</body>
</html>
";
    }

    // line 4
    public function block_page_title($context, array $blocks = array())
    {
        echo "Control panel";
    }

    // line 6
    public function block_seo($context, array $blocks = array())
    {
        // line 7
        echo "    <meta name=\"description\" content=\"Administration\" />
    <meta name=\"keywords\" content=\"Administration\" />
    ";
    }

    // line 16
    public function block_css($context, array $blocks = array())
    {
        // line 17
        echo "    ";
    }

    // line 29
    public function block_js($context, array $blocks = array())
    {
        // line 30
        echo "    ";
    }

    // line 55
    public function block_left_menu($context, array $blocks = array())
    {
        // line 56
        echo "                    <div class=\"acc_info\">
                    <ul>
                        <li>Welcome, Admin</li>
                        <li><a href=\"/\" target=\"_blank\">Go to site</a></li>
                        ";
        // line 61
        echo "                        <li><a href=\"/logout\">Logout</a></li>
                    </ul>
                    </div>
                    <div id=\"sidebar\" class=\"profile_actions\">
                    <ul id=\"main-nav\">  <!-- Accordion Menu -->
                        <li>
                            <a class=\"nav-top-item no-submenu";
        // line 67
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "users")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageUsers", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Manage Users</a>
                        </li>
                        <li>
                            <a class=\"nav-top-item no-submenu";
        // line 70
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "merchants")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageMerchants", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Agents/Merchants</a>
                        </li>
                        <li>
                            <a class=\"nav-top-item no-submenu";
        // line 73
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "commission")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageCommissions", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Manage Commissions</a>
                        </li>
                        ";
        // line 78
        echo "                        <li>
                            <a class=\"nav-top-item";
        // line 79
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "transactions")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageTransactions", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Manage Transactions</a>
                        </li>
                        ";
        // line 84
        echo "                        <li>
                            <a class=\"nav-top-item";
        // line 85
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "bank")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageBank", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Manage Bank</a>
                        </li>
                        ";
        // line 90
        echo "                        <li>
                            <a class=\"nav-top-item";
        // line 91
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "products")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageProducts", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Deal Offers</a>
                        </li>
                        ";
        // line 96
        echo "                        ";
        // line 99
        echo "                        ";
        // line 102
        echo "                        ";
        // line 105
        echo "\t\t\t\t\t\t\t\t\t\t\t\t<li>
                            <a class=\"nav-top-item";
        // line 106
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "my_network")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myNetwork", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">My Network Links</a>
                        </li>
                    </ul>
                    </div>
                ";
    }

    // line 115
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layouts/layout.twig";
    }

    public function isTraitable()
    {
        return true;
    }
}
