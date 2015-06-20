<p>
  {translate '{$inviter} hat dich eingeladen, einen Hipster-Account für Denkmal Now zu erstellen!' inviter=$userInvite->getInviter()->getDisplayName()|escape}
</p>

<p>
  {load file='Mail/helper/button.tpl' label={translate 'Account Erstellen'} href={linkUrl page='Denkmal_Page_SignUp' invite=$userInvite->getKey()}}
</p>

{if $userInvite->getExpires()}
  <p>
    ({translate 'Diese Einladung ist gültig bis {$expires}.' expires={date_timeago time=$userInvite->getExpires()->getTimestamp()}})
  </p>
{/if}

<p>
  {translate 'Denkmal Now erlaubt dir, mit dem Mobiltelefon anderen Leuten mitzuteilen, was du gerade so treibst im Nachtleben.'}<br />
</p>
<ul>
  <li>{translate 'Login und Account-Einstellungen via Schnurrbart auf {$link}.' link={linkDomainShort page='Denkmal_Page_Now'}}</li>
  <li>{translate 'Deine Nachrichten sollen ein Stimmungsbild der Veranstaltung vermitteln.'}</li>
  <li>{translate 'Fotos bitte nur im Einvernehmen mit abgebildeten Personen hochladen.'}</li>
</ul>
