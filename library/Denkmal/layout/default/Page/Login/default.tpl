{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {component name='Denkmal_Component_Login'}
  <hr />
  <div class="hipster-info">
    {translate 'Denkmal Hipster have special access rights. <a href="{$urlEmail}">Contact us</a> if you\'re interested.' urlEmail="mailto:{$emailAddress}"}
  </div>
{/block}
