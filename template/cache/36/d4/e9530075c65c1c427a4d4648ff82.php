<?php

/* ./i18n/home-slider.twig */
class __TwigTemplate_36d4e9530075c65c1c427a4d4648ff82 extends Twig_Template
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
        if (($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "slug") == "esp")) {
            // line 2
            echo "<div class=\"slide\" data-animation=\"slideleft\">
    <div class=\"row-fluid\">
        <div class=\"span5\">
            <div class=\"text pull-left\">
                <div class=\"title text-uppercase\">PROJEGGT ES CROWDFUNDING CON ASESORAMIENTO EXPERTO</div>
                <div class=\"subtitle\"></div>
            </div>
        </div>
        <div class=\"span7 align-right\">
            <img src=\"/image/0/250/1/design/egg1.jpg/\" class=\"margin-2t\"/>
        </div>
    </div>
</div>
<div class=\"slide\" data-animation=\"slideleft\">
    <div class=\"row-fluid\">
        <div class=\"span5\">
            <div class=\"text pull-left\">
                <div class=\"title text-uppercase\">PROJEGGT ES EL SITIO WEB DONDE LOS PROYECTOS ECLOSIONAN</div>
                <div class=\"subtitle\"></div>
            </div>
        </div>
        <div class=\"span7 align-right\">
            <img src=\"/static/images/design/egg2.jpg\"/>
        </div>
    </div>
</div>
";
        } elseif (($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "slug") == "cat")) {
            // line 29
            echo "<div class=\"slide\" data-animation=\"slideleft\">
    <div class=\"row-fluid\">
        <div class=\"span5\">
            <div class=\"text pull-left\">
                <div class=\"title text-uppercase\">PROJEGGT ÉS CROWDFUNDING AMB ASSESSORAMENT EXPERT</div>
                <div class=\"subtitle\"></div>
            </div>
        </div>
        <div class=\"span7 align-right\">
            <img src=\"/image/0/250/1/design/egg1.jpg/\" class=\"margin-2t\"/>
        </div>
    </div>
</div>
<div class=\"slide\" data-animation=\"slideleft\">
    <div class=\"row-fluid\">
        <div class=\"span5\">
            <div class=\"text pull-left\">
                <div class=\"title text-uppercase\">PROJEGGT ÉS EL LLOC WEB ON ELS PROJECTES FAN ECLOSIÓ</div>
                <div class=\"subtitle\"></div>
            </div>
        </div>
        <div class=\"span7 align-right\">
            <img src=\"/static/images/design/egg2.jpg\"/>
        </div>
    </div>
</div>
";
        } elseif (($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "slug") == "eng")) {
            // line 56
            echo "<div class=\"slide\" data-animation=\"slideleft\">
    <div class=\"row-fluid\">
        <div class=\"span5\">
            <div class=\"text pull-left\">
                <div class=\"title text-uppercase\">PROJEGGT IS CROWDFUNDING WITH EXPERT ADVICE</div>
                <div class=\"subtitle\"></div>
            </div>
        </div>
        <div class=\"span7 align-right\">
            <img src=\"/image/0/250/1/design/egg1.jpg/\" class=\"margin-2t\"/>
        </div>
    </div>
</div>
<div class=\"slide\" data-animation=\"slideleft\">
    <div class=\"row-fluid\">
        <div class=\"span5\">
            <div class=\"text pull-left\">
                <div class=\"title text-uppercase\">PROJEGGT IS THE WEBSITE WHERE PROJECTS ARE HATCHED</div>
                <div class=\"subtitle\"></div>
            </div>
        </div>
        <div class=\"span7 align-right\">
            <img src=\"/static/images/design/egg2.jpg\"/>
        </div>
    </div>
</div>
";
        }
        // line 83
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["slideProject"]) ? $context["slideProject"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
            // line 84
            echo "<div class=\"slide\" data-animation=\"slideleft\">
    <a href=\"";
            // line 85
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "URLSummary"), "html", null, true);
            echo "\">
        <div class=\"row-fluid\">
            <div class=\"span5\">
                <div class=\"text pull-left\">
                    <div class=\"title\">";
            // line 89
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "name"), "html", null, true);
            echo "</div>
                    <div class=\"subtitle\">";
            // line 90
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "shortDescription"), "html", null, true);
            echo "</div>
                </div>
            </div>
            <div class=\"span7 align-right\">
                <div class=\"position-relative pull-right\">
                    <div class=\"position-absolute image-cut\"></div>
                    <img src=\"/image/512/310/0/";
            // line 96
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["project"]) ? $context["project"] : null), "mainImage"), "html", null, true);
            echo "/\"/>
                </div>
            </div>
        </div>
    </a>
</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
    }

    public function getTemplateName()
    {
        return "./i18n/home-slider.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 96,  124 => 90,  113 => 85,  110 => 84,  19 => 2,  17 => 1,  402 => 129,  391 => 127,  387 => 126,  383 => 124,  375 => 117,  370 => 113,  326 => 95,  299 => 86,  296 => 85,  289 => 81,  285 => 80,  280 => 78,  272 => 75,  265 => 70,  262 => 69,  256 => 66,  251 => 65,  245 => 63,  243 => 62,  237 => 61,  234 => 60,  228 => 57,  210 => 55,  206 => 54,  197 => 47,  178 => 44,  174 => 43,  167 => 42,  150 => 41,  144 => 37,  136 => 30,  131 => 8,  125 => 6,  117 => 133,  115 => 123,  108 => 118,  106 => 83,  101 => 114,  99 => 113,  93 => 109,  91 => 36,  87 => 34,  81 => 32,  79 => 31,  73 => 30,  53 => 13,  47 => 9,  41 => 7,  37 => 6,  27 => 2,  24 => 1,  380 => 123,  377 => 117,  360 => 103,  352 => 97,  341 => 94,  337 => 93,  331 => 90,  324 => 85,  313 => 83,  309 => 94,  305 => 81,  298 => 76,  281 => 74,  264 => 73,  258 => 70,  253 => 68,  249 => 66,  232 => 59,  215 => 63,  209 => 60,  204 => 58,  198 => 55,  194 => 53,  189 => 50,  172 => 48,  155 => 47,  149 => 44,  143 => 42,  141 => 36,  137 => 39,  120 => 89,  103 => 36,  97 => 33,  92 => 31,  86 => 27,  80 => 26,  77 => 56,  71 => 23,  69 => 22,  66 => 21,  63 => 20,  57 => 16,  55 => 15,  48 => 29,  45 => 8,  39 => 7,  33 => 5,  30 => 2,);
    }
}
