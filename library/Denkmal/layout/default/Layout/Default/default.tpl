{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name="before-html"}
<!--

WASLOIFT IN BASEL?
==================
Denkmal.org is an Oi!-project and aims to serve as an alternative event
calendar for the city of Basel.


Open source
-----------
Fork, contribute, open issues! Denkmal.org is on Github and licensed under MIT.
https://github.com/denkmal/denkmal.org


Made in Basel
-------------
Proud member of "Made in Basel", the city's local IT-label.
http://www.madeinbasel.org


Thanks!
-------
Denkmal.org wouldn't be possible without the help of Cargo Media - they're hiring!
http://www.cargomedia.ch


-->
{/block}
{block name='tileColor'}#3CC94D{/block}

{block name='body'}
  <header id="header">
    <div class="sheet">
      {block name='header'}
        {component name='Denkmal_Component_HeaderBar'}
      {/block}
    </div>
  </header>
  <section id="middle" class="sheet">
    {$renderAdapter->fetchPage()}
  </section>
  {component name='Denkmal_Component_SongPlayer'}
{/block}
