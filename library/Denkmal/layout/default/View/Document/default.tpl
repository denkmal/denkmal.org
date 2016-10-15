{extends file=$render->getLayoutPath('View/Document/default.tpl', 'CM')}

{block name="before-html"}
  <!--

  Denkmal.org Event Calendar
  ==========================
  Denkmal.org is an Oi!-project and aims to serve as an alternative event
  calendar for your city.


  Open source
  -----------
  Fork, contribute, open issues! Denkmal.org is on GitHub and licensed under MIT.
  https://github.com/denkmal/denkmal.org


  Made in Basel
  -------------
  Proud member of "Made in Basel", the city's local DIY-label.
  http://www.madeinbasel.org


  Thanks!
  -------
  Denkmal.org wouldn't be possible without the help of Cargo Media - they're hiring!
  http://www.cargomedia.ch


  -->
{/block}

{block name='head'}
  <meta property="og:url" content="{$renderDefault->getUrlPage($page, $page->getParams()->getParamsEncoded())|escape}" />
  <meta property="og:title" content="{$title|escape}" />
  <meta property="og:type" content="website" />
  {strip}{if isset($metaDescription)}
    <meta property="og:description" content="{$metaDescription|escape}" />
  {/if}{/strip}
  <meta property="og:image" content="{resourceUrl path='img/meta/og-large.png' type='layout'}" />
{/block}
