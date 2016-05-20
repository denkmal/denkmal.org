{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {translate 'Invitation link is not valid or has expired.'}
  <br />
  {translate '<a href="{$urlEmail}">Contact us</a> for help.' urlEmail="mailto:{$render->getSite()->getEmailAddress()}"}
{/block}
