<?php

/* 404.twig */
class __TwigTemplate_3db97416c1d41b502eec3acbb76ca112 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.twig");

        $this->blocks = array(
            'bodyClass' => array($this, 'block_bodyClass'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_bodyClass($context, array $blocks = array())
    {
        echo "no-hero-shadow";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<div class=\"center width align-center\">
    <h1>404</h1>
    <p>";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "sorry-we-cant-find-page-you-are-looking-for"), "method"), "html", null, true);
        echo "</p>

    <p><a href=\"/\" class=\"btn\">";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "go-back"), "method"), "html", null, true);
        echo "</a></p>
</div>
";
    }

    public function getTemplateName()
    {
        return "404.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 10,  40 => 8,  36 => 6,  33 => 5,  27 => 3,);
    }
}
