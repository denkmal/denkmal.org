<p>
  {load file='Mail/helper/button.tpl' label={translate 'Create Account'} href={linkUrl page='Denkmal_Page_SignUp' invite=$userInvite->getKey()}}
</p>

{if $userInvite->getExpires()}
  <p>
    ({translate 'Invitation expires: {$expires}.' expires={date_timeago time=$userInvite->getExpires()->getTimestamp()}})
  </p>
{/if}
