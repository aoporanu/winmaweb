<?php

/* /forms/forms.twig */
class __TwigTemplate_33e2d053ccb2b507096051b2a842fb8f extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 4
        echo "
";
        // line 8
        echo "
";
        // line 16
        echo "    
";
        // line 24
        echo "    
";
        // line 28
        echo "    
";
        // line 32
        echo "    
";
    }

    // line 1
    public function getinput($name = null, $value = null, $type = null, $id = null, $size = null)
    {
        $context = array_merge($this->env->getGlobals(), array(
            "name" => $name,
            "value" => $value,
            "type" => $type,
            "id" => $id,
            "size" => $size,
        ));

        ob_start();
        try {
            // line 2
            echo "    <input type=\"";
            if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
            echo twig_escape_filter($this->env, ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "text")) : ("text")), "html", null, true);
            echo "\" name=\"";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, $_name_, "html", null, true);
            echo "\" id=\"";
            if (isset($context["id"])) { $_id_ = $context["id"]; } else { $_id_ = null; }
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, ((array_key_exists("id", $context)) ? (_twig_default_filter($_id_, $_name_)) : ($_name_)), "html", null, true);
            echo "\" value=\"";
            if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
            echo twig_escape_filter($this->env, $_value_);
            echo "\" size=\"";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo twig_escape_filter($this->env, ((array_key_exists("size", $context)) ? (_twig_default_filter($_size_, 20)) : (20)), "html", null, true);
            echo "\" />
";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    // line 5
    public function getinput_book($name = null, $value = null, $type = null, $id = null, $size = null)
    {
        $context = array_merge($this->env->getGlobals(), array(
            "name" => $name,
            "value" => $value,
            "type" => $type,
            "id" => $id,
            "size" => $size,
        ));

        ob_start();
        try {
            // line 6
            echo "    <input type=\"";
            if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
            echo twig_escape_filter($this->env, ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "text")) : ("text")), "html", null, true);
            echo "\" name=\"";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, $_name_, "html", null, true);
            echo "\" id=\"";
            if (isset($context["id"])) { $_id_ = $context["id"]; } else { $_id_ = null; }
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, ((array_key_exists("id", $context)) ? (_twig_default_filter($_id_, $_name_)) : ($_name_)), "html", null, true);
            echo "\" value=\"";
            if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
            echo twig_escape_filter($this->env, $_value_);
            echo "\" class=\"change\" size=\"";
            if (isset($context["size"])) { $_size_ = $context["size"]; } else { $_size_ = null; }
            echo twig_escape_filter($this->env, ((array_key_exists("size", $context)) ? (_twig_default_filter($_size_, 20)) : (20)), "html", null, true);
            echo "\" />
";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    // line 9
    public function getselect_book($name = null, $options = null, $value = null, $id = null)
    {
        $context = array_merge($this->env->getGlobals(), array(
            "name" => $name,
            "options" => $options,
            "value" => $value,
            "id" => $id,
        ));

        ob_start();
        try {
            // line 10
            echo "    <select name=\"";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, $_name_, "html", null, true);
            echo "\" id=\"";
            if (isset($context["id"])) { $_id_ = $context["id"]; } else { $_id_ = null; }
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, ((array_key_exists("id", $context)) ? (_twig_default_filter($_id_, $_name_)) : ($_name_)), "html", null, true);
            echo "\" class=\"s_change\">
        ";
            // line 11
            if (isset($context["options"])) { $_options_ = $context["options"]; } else { $_options_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_options_);
            foreach ($context['_seq'] as $context["key"] => $context["option"]) {
                // line 12
                echo "        <option value=\"";
                if (isset($context["key"])) { $_key_ = $context["key"]; } else { $_key_ = null; }
                echo twig_escape_filter($this->env, $_key_, "html", null, true);
                echo "\"";
                if (isset($context["key"])) { $_key_ = $context["key"]; } else { $_key_ = null; }
                if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
                if (($_key_ == $_value_)) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
                echo twig_escape_filter($this->env, $_option_, "html", null, true);
                echo "</option>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 14
            echo "    </select>
";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    // line 17
    public function getselect($name = null, $options = null, $value = null, $id = null)
    {
        $context = array_merge($this->env->getGlobals(), array(
            "name" => $name,
            "options" => $options,
            "value" => $value,
            "id" => $id,
        ));

        ob_start();
        try {
            // line 18
            echo "    <select name=\"";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, $_name_, "html", null, true);
            echo "\" id=\"";
            if (isset($context["id"])) { $_id_ = $context["id"]; } else { $_id_ = null; }
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, ((array_key_exists("id", $context)) ? (_twig_default_filter($_id_, $_name_)) : ($_name_)), "html", null, true);
            echo "\">
        ";
            // line 19
            if (isset($context["options"])) { $_options_ = $context["options"]; } else { $_options_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_options_);
            foreach ($context['_seq'] as $context["key"] => $context["option"]) {
                // line 20
                echo "        <option value=\"";
                if (isset($context["key"])) { $_key_ = $context["key"]; } else { $_key_ = null; }
                echo twig_escape_filter($this->env, $_key_, "html", null, true);
                echo "\"";
                if (isset($context["key"])) { $_key_ = $context["key"]; } else { $_key_ = null; }
                if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
                if (($_key_ == $_value_)) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
                echo twig_escape_filter($this->env, $_option_, "html", null, true);
                echo "</option>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 22
            echo "    </select>
";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    // line 25
    public function gettextarea($name = null, $value = null)
    {
        $context = array_merge($this->env->getGlobals(), array(
            "name" => $name,
            "value" => $value,
        ));

        ob_start();
        try {
            // line 26
            echo "    <textarea id=\"";
            if (isset($context["id"])) { $_id_ = $context["id"]; } else { $_id_ = null; }
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, ((array_key_exists("id", $context)) ? (_twig_default_filter($_id_, $_name_)) : ($_name_)), "html", null, true);
            echo "\" name=\"";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, $_name_, "html", null, true);
            echo "\">";
            if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
            echo twig_escape_filter($this->env, $_value_);
            echo "</textarea>
";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    // line 29
    public function gettextarea_editor($name = null, $value = null)
    {
        $context = array_merge($this->env->getGlobals(), array(
            "name" => $name,
            "value" => $value,
        ));

        ob_start();
        try {
            // line 30
            echo "    <textarea id=\"";
            if (isset($context["id"])) { $_id_ = $context["id"]; } else { $_id_ = null; }
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, ((array_key_exists("id", $context)) ? (_twig_default_filter($_id_, $_name_)) : ($_name_)), "html", null, true);
            echo "\" name=\"";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, $_name_, "html", null, true);
            echo "\" class=\"tinymce\">";
            if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
            echo $_value_;
            echo "</textarea>
";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    // line 33
    public function geterrors($errors = null)
    {
        $context = array_merge($this->env->getGlobals(), array(
            "errors" => $errors,
        ));

        ob_start();
        try {
            // line 34
            echo "    ";
            if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
            if ($_errors_) {
                // line 35
                echo "        <ul class=\"errors\">
        ";
                // line 36
                if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($_errors_);
                foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                    // line 37
                    echo "            <li>";
                    if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
                    echo twig_escape_filter($this->env, $_error_, "html", null, true);
                    echo "</li>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 39
                echo "        </ul>
    ";
            }
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    public function getTemplateName()
    {
        return "/forms/forms.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
