{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}

{block name='content-main'}
  {component name='Denkmal_Component_Login'}
  <hr />
  <div class="hipster-info">
    {translate 'Denkmal Hipster haben spezielle Berechtigungen. <a href="{$urlEmail}">Kontaktiere uns</a> bei Interesse.' urlEmail="mailto:{$render->getSite()->getEmailAddress()}"}
  </div>
{/block}
