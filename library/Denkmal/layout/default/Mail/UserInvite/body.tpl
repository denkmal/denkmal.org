<p>
  {translate '{$inviter} invited you to create a hipster account!' inviter=$userInvite->getInviter()->getDisplayName()|escape}
</p>

<p>
  {load file='Mail/helper/button.tpl' label={translate 'Create account'} href={linkUrl page='Denkmal_Page_SignUp' invite=$userInvite->getKey()}}
</p>

{if $userInvite->getExpires()}
  <p>
    ({translate 'Invitation expires: {$expires}.' expires={date_timeago time=$userInvite->getExpires()->getTimestamp()}})
  </p>
{/if}

<p>
  {translate 'Denkmal Now allows you to share your nightlife experiences in real-time.'}<br />
</p>
<ul>
  <li>{translate 'Login and account settings via mustache {$link}.' link={linkDomainShort page='Denkmal_Page_Now'}}</li>
  <li>{translate 'Your messages should represent a venue\'s vibe.'}</li>
  <li>{translate 'Please only upload pictures that photographed people have approved.'}</li>
</ul>
