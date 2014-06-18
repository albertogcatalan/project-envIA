<?php

/* project-box.twig */
class __TwigTemplate_dbe870a5240ee3feb6883d2615188c31 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if ((!$this->getAttribute((isset($context["project"]) ? $context["project"] : null), "id"))) {
            // line 2
            echo "<div class=\"project-box white\">
    <a href=\"/start-your-projeggt/\">
        <div class=\"submit-your-project border-small border-black\">
            <div class=\"margin-4l margin-4t\">
                ";
            // line 7
            echo "                ";
            $this->env->loadTemplate("i18n/submit-your-project.twig")->display(array_merge($context, array("language" => $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "slug"))));
            // line 8
            echo "                ";
            // line 9
            echo "            </div>
        </div>
    </a>
</div>
";
        } else {
            // line 14
            echo "<div class=\"project-box\">
    <a href=\"";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "url"), "html", null, true);
            echo "\">
        ";
            // line 21
            echo "        <div class=\"type non-css3\">
            ";
            // line 22
            if ($this->getAttribute((isset($context["project"]) ? $context["project"] : null), "hatched")) {
                // line 23
                echo "                <img src=\"/static/images/ribbon-hatched-";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "slug"), "html", null, true);
                echo ".png\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "hatched"), "method"), "html", null, true);
                echo "\"/>
            ";
            } else {
                // line 25
                echo "                <img src=\"/static/images/ribbon-";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "projectType"), "html", null, true);
                echo "-";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "slug"), "html", null, true);
                echo ".png\"
                     alt=\"";
                // line 26
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "projectType")), "method"), "html", null, true);
                echo "\"/>
            ";
            }
            // line 28
            echo "        </div>
        <div class=\"image align-center\">
            <img src=\"/";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "mainImage"), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "name"), "html", null, true);
            echo "\"/>
        </div>
    </a>
    <div class=\"category orange align-center contrast text-uppercase\">
        <a href=\"";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["project"]) ? $context["project"] : null), "category"), "url"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["project"]) ? $context["project"] : null), "category"), "name"), "html", null, true);
            echo "</a>
    </div>
    <a href=\"";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "url"), "html", null, true);
            echo "\">
        <div class=\"info padding-2l padding-2r padding-1t padding-1b\">
            <div class=\"name text-uppercase\">
                ";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "name"), "html", null, true);
            echo "
            </div>
            <div class=\"author font-small\">
                ";
            // line 42
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "by", array(), "array"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["project"]) ? $context["project"] : null), "author"), "name"), "html", null, true);
            echo "
            </div>
            <div class=\"summary\">
                ";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "shortDescription"), "html", null, true);
            echo "
            </div>
            <div class=\"detailed padding-1t\">
                ";
            // line 48
            ob_start();
            // line 49
            echo "                <div class=\"progress progress-warning center darkgray\">
                    <div class=\"orange bar filled-";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "percentage"), "html", null, true);
            echo "\"></div>
                </div>
                ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            // line 53
            echo "                <div class=\"bar-info center text-small bold no-shadow\">
                    <span class=\"start\">";
            // line 54
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "pledged"), 0), "html", null, true);
            echo "&euro;</span>
                    <span class=\"end pull-right\">";
            // line 55
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "goal"), 0), "html", null, true);
            echo "&euro;</span>
                </div>
                <div class=\"detail row-fluid align-center padding-1t darker\">
                    <div class=\"span4\">
                        <span class=\"text-uppercase\">";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "funded", array(), "array"), "html", null, true);
            echo "</span>
                        <span class=\"display-block bold font-big\">";
            // line 60
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "percentage"), "html", null, true);
            echo "%</span>
                    </div>
                    <div class=\"span4\">
                        <span class=\"text-uppercase\">";
            // line 63
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "pledged", array(), "array"), "html", null, true);
            echo "</span>
                        <span class=\"display-block bold font-big\">";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "pledged"), "html", null, true);
            echo "&euro;</span>
                    </div>
                    <div class=\"span4\">
                        ";
            // line 67
            if (($this->getAttribute((isset($context["project"]) ? $context["project"] : null), "remaining") > 0)) {
                // line 68
                echo "                        <span class=\"text-uppercase\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "remaining", array(), "array"), "html", null, true);
                echo "</span>
                        <span class=\"display-block bold font-big\">
                            ";
                // line 70
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "remaining"), "html", null, true);
                echo "
                        </span>
                        ";
            } elseif ((($this->getAttribute((isset($context["project"]) ? $context["project"] : null), "remaining") == 0) && ($this->getAttribute((isset($context["project"]) ? $context["project"] : null), "status") == "accepted"))) {
                // line 73
                echo "                        <span class=\"text-uppercase\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "remaining", array(), "array"), "html", null, true);
                echo "</span>
                        <span class=\"display-block bold font-big\">
                            &#8734;
                        </span>
                        ";
            } else {
                // line 78
                echo "                            ";
                if ($this->getAttribute((isset($context["project"]) ? $context["project"] : null), "hatched")) {
                    // line 79
                    echo "                                <img src=\"/static/images/check.png\" />
                            ";
                } else {
                    // line 81
                    echo "                                <span class=\"text-uppercase\">&nbsp;</span>
                                <span class=\"display-block bold font-big\">
                                ";
                    // line 83
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "finished", array(), "array"), "html", null, true);
                    echo "
                                </span>
                            ";
                }
                // line 86
                echo "                        ";
            }
            // line 87
            echo "                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "project-box.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  203 => 87,  200 => 86,  190 => 81,  186 => 79,  183 => 78,  168 => 70,  162 => 68,  160 => 67,  154 => 64,  140 => 59,  129 => 54,  126 => 53,  109 => 45,  95 => 39,  89 => 36,  82 => 34,  64 => 26,  49 => 23,  44 => 21,  40 => 15,  28 => 8,  25 => 7,  133 => 55,  124 => 90,  113 => 85,  110 => 84,  19 => 2,  17 => 1,  402 => 129,  391 => 127,  387 => 126,  383 => 124,  375 => 117,  370 => 113,  326 => 95,  299 => 86,  296 => 85,  289 => 81,  285 => 80,  280 => 78,  272 => 75,  265 => 70,  262 => 69,  256 => 66,  251 => 65,  245 => 63,  243 => 62,  237 => 61,  234 => 60,  228 => 57,  210 => 55,  206 => 54,  197 => 47,  178 => 44,  174 => 73,  167 => 42,  150 => 63,  144 => 60,  136 => 30,  131 => 8,  125 => 6,  117 => 49,  115 => 48,  108 => 118,  106 => 83,  101 => 42,  99 => 113,  93 => 109,  91 => 36,  87 => 34,  81 => 32,  79 => 31,  73 => 30,  53 => 13,  47 => 22,  41 => 7,  37 => 14,  27 => 2,  24 => 1,  380 => 123,  377 => 117,  360 => 103,  352 => 97,  341 => 94,  337 => 93,  331 => 90,  324 => 85,  313 => 83,  309 => 94,  305 => 81,  298 => 76,  281 => 74,  264 => 73,  258 => 70,  253 => 68,  249 => 66,  232 => 59,  215 => 63,  209 => 60,  204 => 58,  198 => 55,  194 => 83,  189 => 50,  172 => 48,  155 => 47,  149 => 44,  143 => 42,  141 => 36,  137 => 39,  120 => 50,  103 => 36,  97 => 33,  92 => 31,  86 => 27,  80 => 26,  77 => 56,  71 => 23,  69 => 28,  66 => 21,  63 => 20,  57 => 25,  55 => 15,  48 => 29,  45 => 8,  39 => 7,  33 => 5,  30 => 9,);
    }
}
