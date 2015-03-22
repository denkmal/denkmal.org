{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {translate 'Dieser Einladungslink ist ungültig oder abgelaufen.'}
  <br />
  {translate '<a href="{$urlEmail}">Kontaktiere uns</a> bei Fragen.' urlEmail="mailto:{$render->getSite()->getEmailAddress()}"}
{/block}
