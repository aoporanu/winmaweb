<?php

/* myaccount/menu.twig */
class __TwigTemplate_e672341ec2fae7f00a21517adbe32750 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<h1 class=\"text-right\">My Account</h1>
<ul class=\"ma_menu\">
\t<li class=\"sub";
        // line 3
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (((((((((((((($_ma_menu_ == "memberSection") || ($_ma_menu_ == "myBoughtDeals")) || ($_ma_menu_ == "myWMWCredits")) || ($_ma_menu_ == "myMoney")) || ($_ma_menu_ == "network")) || ($_ma_menu_ == "buildMyNetwork")) || ($_ma_menu_ == "editAccount")) || ($_ma_menu_ == "photo")) || ($_ma_menu_ == "chpass")) || ($_ma_menu_ == "becomeAnAgent")) || ($_ma_menu_ == "contract")) || ($_ma_menu_ == "myMessenger")) || ($_ma_menu_ == "myFriends"))) {
            echo " sub_open";
        }
        echo "\">
\t\t<a href=\"";
        // line 4
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccount", ), "method"), "html", null, true);
        echo "\"";
        echo " class=\"acc\">Member Section</a>
\t\t<a href=\"#\" class=\"right tog\" style=\"display: block;width:30px;height:30px;margin-top:-7px;margin-right:-5px;\">&nbsp;</a>
\t\t<ul class=\"sub_menu2";
        // line 6
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (((((((((((((($_ma_menu_ == "memberSection") || ($_ma_menu_ == "myBoughtDeals")) || ($_ma_menu_ == "myWMWCredits")) || ($_ma_menu_ == "myMoney")) || ($_ma_menu_ == "network")) || ($_ma_menu_ == "buildMyNetwork")) || ($_ma_menu_ == "editAccount")) || ($_ma_menu_ == "photo")) || ($_ma_menu_ == "chpass")) || ($_ma_menu_ == "becomeAnAgent")) || ($_ma_menu_ == "contract")) || ($_ma_menu_ == "myMessenger")) || ($_ma_menu_ == "myFriends"))) {
        } else {
            echo " inv";
        }
        echo "\">
\t\t\t<li class=\"first\"><a href=\"";
        // line 7
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccount", ), "method"), "html", null, true);
        echo "\">My Profile</a></li>
\t\t\t<li><a href=\"";
        // line 8
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyBoughtDeals", ), "method"), "html", null, true);
        echo "\"";
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (($_ma_menu_ == "myBoughtDeals")) {
            echo " class=\"selected\"";
        }
        echo ">My Bought Deals</a></li>
\t\t\t<li><a href=\"";
        // line 9
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyWMWCredits", ), "method"), "html", null, true);
        echo "\"";
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (($_ma_menu_ == "myWMWCredits")) {
            echo " class=\"selected\"";
        }
        echo ">My WMW Credits</a></li>
\t\t\t<li><a href=\"";
        // line 10
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyMoney", ), "method"), "html", null, true);
        echo "\"";
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (($_ma_menu_ == "myMoney")) {
            echo " class=\"selected\"";
        }
        echo ">My Money</a></li>
\t\t\t<li><a href=\"";
        // line 11
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountReceivedMessages", ), "method"), "html", null, true);
        echo "\"";
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (($_ma_menu_ == "myMessenger")) {
            echo " class=\"selected\"";
        }
        echo ">My Messages</a>&nbsp;<div class=\"messages\" style=\"position:relative;left:90px;top:5px;display:inline-block;\"></div></li>
\t\t\t<li><a href=\"";
        // line 12
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyFriends", ), "method"), "html", null, true);
        echo "\"";
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (($_ma_menu_ == "myFriends")) {
            echo " class=\"selected\"";
        }
        echo ">My Friends</a>&nbsp;<div class=\"friends\" style=\"position:relative;left:5%;display:inline-block;left:120px;\"></div></li>
\t\t\t<li class=\"sub";
        // line 13
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if ((($_ma_menu_ == "network") || ($_ma_menu_ == "buildMyNetwork"))) {
            echo " sub_open";
        }
        echo "\">
\t\t\t\t<a href=\"";
        // line 14
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyNetwork", ), "method"), "html", null, true);
        echo "\" class=\"acc\">My Network</a>
\t\t\t\t<a href=\"#\" class=\"right tog\" style=\"display: block;width:30px;height:30px;margin-top:-7px;margin-right:-5px;\">&nbsp;</a>
\t\t\t\t<ul class=\"sub_menu3";
        // line 16
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if ((($_ma_menu_ == "network") || ($_ma_menu_ == "buildMyNetwork"))) {
        } else {
            echo " inv";
        }
        echo "\">
\t\t\t\t\t<li class=\"first\"><a href=\"";
        // line 17
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountNetworkStatistics", ), "method"), "html", null, true);
        echo "\"";
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (($_ma_menu_ == "network")) {
            echo " class=\"selected\"";
        }
        echo ">Network Statistics</a></li>
\t\t\t\t\t<li><a href=\"";
        // line 18
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountViewMyNetwork", ), "method"), "html", null, true);
        echo "\" class=\"modal-refvisual\">View My Network</a></li>
\t\t\t\t\t<li class=\"last\"><a href=\"";
        // line 19
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountBuildMyNetwork", ), "method"), "html", null, true);
        echo "\"";
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (($_ma_menu_ == "buildMyNetwork")) {
            echo " class=\"selected\"";
        }
        echo ">Build My Network</a></li>
\t\t\t\t</ul>
\t\t\t</li>
\t\t\t
\t\t\t<li class=\"";
        // line 23
        if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
        if (($this->getAttribute($_userObj_, "hasRole", array("AGENT", ), "method") && $this->getAttribute($_userObj_, "hasRole", array("SHOP", ), "method"))) {
            echo "last ";
        }
        echo "sub";
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (((($_ma_menu_ == "editAccount") || ($_ma_menu_ == "photo")) || ($_ma_menu_ == "chpass"))) {
            echo " sub_open";
        }
        echo "\">
\t\t\t\t<a href=\"";
        // line 24
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountEdit", ), "method"), "html", null, true);
        echo "\" class=\"acc";
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (($_ma_menu_ == "editAccount")) {
            echo " selected";
        }
        echo "\">Edit Account</a>
\t\t\t\t<a href=\"#\" class=\"right tog\" style=\"display: block;width:30px;height:30px;margin-top:-7px;margin-right:-5px;\">&nbsp;</a>
\t\t\t\t<ul class=\"sub_menu3";
        // line 26
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (((($_ma_menu_ == "editAccount") || ($_ma_menu_ == "photo")) || ($_ma_menu_ == "chpass"))) {
        } else {
            echo " inv";
        }
        echo "\">
\t\t\t\t\t<li class=\"first\"><a href=\"";
        // line 27
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountEdit?ac=photo", ), "method"), "html", null, true);
        echo "\" ";
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (($_ma_menu_ == "photo")) {
            echo " class=\"selected\"";
        }
        echo ">Add Photo</a></li>
\t\t\t\t\t<li class=\"last\"><a href=\"";
        // line 28
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountchPass", ), "method"), "html", null, true);
        echo "\"";
        if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
        if (($_ma_menu_ == "chpass")) {
            echo " class=\"selected\"";
        }
        echo ">Change Password</a></li>
\t\t\t\t</ul>
\t\t\t</li>
\t\t\t";
        // line 31
        if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
        if ((!$this->getAttribute($_userObj_, "hasRole", array("AGENT", ), "method"))) {
            // line 32
            echo "\t\t\t\t<li";
            if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
            if ($this->getAttribute($_userObj_, "hasRole", array("SHOP", ), "method")) {
                echo " class=\"last\"";
            }
            echo "><a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountBecomeAnAgent", ), "method"), "html", null, true);
            echo "\"";
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if (($_ma_menu_ == "becomeAnAgent")) {
                echo " class=\"selected\"";
            }
            echo ">Become an Agent</a></li>
\t\t\t";
        }
        // line 34
        echo "\t\t\t";
        if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
        if ((!$this->getAttribute($_userObj_, "hasRole", array("SHOP", ), "method"))) {
            // line 35
            echo "\t\t\t\t<li class=\"last\"><a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountBecomeMerchant", ), "method"), "html", null, true);
            echo "\"";
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if (($_ma_menu_ == "contract")) {
                echo " class=\"selected\"";
            }
            echo ">Become a Merchant</a></li>
\t\t\t";
        }
        // line 37
        echo "\t\t</ul>
\t</li>
\t
\t";
        // line 40
        if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
        if ((!$this->getAttribute($_userObj_, "hasRole", array("AGENT", ), "method"))) {
            // line 41
            echo "\t<li><span class=\"disabled\">Agent Section</span></li>
\t";
        }
        // line 43
        echo "\t";
        if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
        if ($this->getAttribute($_userObj_, "hasRole", array("AGENT", ), "method")) {
            // line 44
            echo "\t<li class=\"sub";
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if ((($_ma_menu_ == "myproducts") || ($_ma_menu_ == "agentCommision"))) {
                echo " sub_open";
            }
            echo "\">
\t\t<a href=\"";
            // line 45
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myProducts", ), "method"), "html", null, true);
            echo "\" class=\"acc\">Agent Section</a>
\t\t<a href=\"#\" class=\"right tog\" style=\"display: block;width:30px;height:30px;margin-top:-7px;margin-right:-5px;\">&nbsp;</a>
\t\t<ul class=\"sub_menu2";
            // line 47
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if ((($_ma_menu_ == "myproducts") || ($_ma_menu_ == "agentCommision"))) {
            } else {
                echo " inv";
            }
            echo "\">
\t\t\t<li class=\"first\"><a href=\"";
            // line 48
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myProducts", ), "method"), "html", null, true);
            echo "\"";
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if (($_ma_menu_ == "myproducts")) {
                echo " class=\"selected\"";
            }
            echo ">My Deal Offers</a></li>
\t\t\t<li class=\"last\"><a href=\"";
            // line 49
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountAgentCommision", ), "method"), "html", null, true);
            echo "\"";
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if (($_ma_menu_ == "agentCommision")) {
                echo " class=\"selected\"";
            }
            echo ">Agent Commision</a></li>
\t\t</ul>
\t</li>
\t
\t\t
\t";
        }
        // line 55
        echo "\t";
        if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
        if ((!$this->getAttribute($_userObj_, "hasRole", array("SHOP", ), "method"))) {
            // line 56
            echo "\t<li><span class=\"disabled\">Merchant Section</span></li>
\t";
        }
        // line 58
        echo "\t";
        if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
        if ($this->getAttribute($_userObj_, "hasRole", array("SHOP", ), "method")) {
            // line 59
            echo "\t<li class=\"sub";
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if ((((($_ma_menu_ == "soldVouchers") || ($_ma_menu_ == "cashInVouchers")) || ($_ma_menu_ == "pendingOffers")) || ($_ma_menu_ == "myproducts"))) {
                echo " sub_open";
            }
            echo "\">
\t\t<a href=\"";
            // line 60
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountSoldVouchers", ), "method"), "html", null, true);
            echo "\" class=\"acc\">Merchant Section</a>
\t\t<a href=\"#\" class=\"right tog\" style=\"display: block;width:30px;height:30px;margin-top:-7px;margin-right:-5px;\">&nbsp;</a>
\t\t<ul class=\"sub_menu2";
            // line 62
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if (((($_ma_menu_ == "soldVouchers") || ($_ma_menu_ == "cashInVouchers")) || ($_ma_menu_ == "pendingOffers"))) {
            } else {
                echo " inv";
            }
            echo "\">
\t\t\t<li class=\"first\"><a href=\"";
            // line 63
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountSoldVouchers", ), "method"), "html", null, true);
            echo "\"";
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if (($_ma_menu_ == "soldVouchers")) {
                echo " class=\"selected\"";
            }
            echo ">Sold Vouchers</a></li>
\t\t\t<li><a href=\"";
            // line 64
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myProducts", ), "method"), "html", null, true);
            echo "\"";
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if (($_ma_menu_ == "myproducts")) {
                echo " class=\"selected\"";
            }
            echo ">My Deal Offers</a></li>
\t\t\t<li><a href=\"";
            // line 65
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountGetMerchantDeals", ), "method"), "html", null, true);
            echo "\" ";
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if (($_ma_menu_ == "pendingOffers")) {
                echo " class=\"selected\" ";
            }
            echo ">Pending Offers</a></li>
\t\t\t<li class=\"last\"><a href=\"";
            // line 66
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountCashInVouchers", ), "method"), "html", null, true);
            echo "\"";
            if (isset($context["ma_menu"])) { $_ma_menu_ = $context["ma_menu"]; } else { $_ma_menu_ = null; }
            if (($_ma_menu_ == "cashInVouchers")) {
                echo " class=\"selected\"";
            }
            echo ">Cash In Vouchers</a></li>
\t\t</ul>
\t</li>
\t";
        }
        // line 70
        echo "</ul>";
    }

    public function getTemplateName()
    {
        return "myaccount/menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
