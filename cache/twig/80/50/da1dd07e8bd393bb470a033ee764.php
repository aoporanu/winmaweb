<?php

/* myaccount/transactions/couponDetails.twig */
class __TwigTemplate_8050da1dd07e8bd393bb470a033ee764 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div style=\"padding-top:10px;\">
    <div style=\"padding:5px;\">Offer: ";
        // line 2
        if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_coupon_, "name"), "html", null, true);
        echo "</div>
    <div style=\"padding:5px;\">Quantity: ";
        // line 3
        if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_coupon_, "quantity"), "html", null, true);
        echo "</div>
    <div style=\"padding:5px;\">Cost: ";
        // line 4
        if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
        echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_coupon_, "price")), "html", null, true);
        echo "</div>
    <div style=\"padding:5px;\">Created at: ";
        // line 5
        if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
        echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_coupon_, "created_at")), "html", null, true);
        echo "</div>
    <div style=\"padding:5px;\">Expires at: ";
        // line 6
        if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
        echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_coupon_, "expire_at")), "html", null, true);
        echo "</div>
    ";
        // line 7
        if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
        if (($this->getAttribute($_coupon_, "friend") == 0)) {
            echo "<div style=\"color: #808080;font-size: 12px;padding-top:10px;\">Voucher Code: ";
            if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_coupon_, "code"), "html", null, true);
            echo "</div>";
        }
        // line 8
        echo "    ";
        if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
        if (($this->getAttribute($_coupon_, "friend") == 0)) {
            echo "<div style=\"color: #808080;font-size: 12px;padding-top:10px;\">Voucher Number: ";
            if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_coupon_, "code2"), "html", null, true);
            echo "</div>";
        }
        // line 9
        echo "</div>
";
        // line 10
        if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
        if (isset($context["user_id"])) { $_user_id_ = $context["user_id"]; } else { $_user_id_ = null; }
        if (($this->getAttribute($_coupon_, "owner_id") == $_user_id_)) {
            // line 11
            echo "\t";
            if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
            if (($this->getAttribute($_coupon_, "friend") == 0)) {
                // line 12
                echo "\t<div style=\"padding-top:10px;\"><a href=\"";
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(((("@myAccountCouponDetails?ac=pdf&coupon_id=" . $this->getAttribute($_coupon_, "id")) . "&friend=") . $this->getAttribute($_coupon_, "friend")), ), "method"), "html", null, true);
                echo "\" class=\"g-button g-button-mda\" target=\"_blank\">Download My Voucher</a></div>
\t<div class=\"info-blue\" style=\"padding-top:10px;\"><p>Note: Your Voucher will be downloaded as a Pdf file which you should save on your computer.</p></div>
\t";
            } else {
                // line 15
                echo "                <div style=\"color: #808080;font-size: 12px;padding-top:10px;\">You sent this coupon as a gift to ";
                if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_coupon_, "Friend"), "username"), "html", null, true);
                echo " (";
                if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_coupon_, "Friend"), "email"), "html", null, true);
                echo "  ";
                if (isset($context["coupon"])) { $_coupon_ = $context["coupon"]; } else { $_coupon_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_coupon_, "Friend"), "ref_id"), "html", null, true);
                echo ")</div>
\t";
            }
        }
    }

    public function getTemplateName()
    {
        return "myaccount/transactions/couponDetails.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
