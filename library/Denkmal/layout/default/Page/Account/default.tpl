{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {component name='Denkmal_Component_Logout'}
  <hr />
  {component name='Denkmal_Component_ChangePassword'}
{/block}
