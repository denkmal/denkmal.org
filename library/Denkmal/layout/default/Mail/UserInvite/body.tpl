<p>
  {translate '{$inviter} hat dich eingeladen, einen Hipster-Account für Denkmal Now zu erstellen!' inviter=$userInvite->getInviter()->getDisplayName()|escape}
</p>

<table cellspacing="0" border="0" cellpadding="0" style="{less}margin: 10px 0; height: @sizeButton; background-color: @colorBgButtonHighlight; color: @colorFgButtonHighlight; border-radius: @borderRadiusInput; border: 1px solid @colorBgButtonHighlight;{/less}">
  <tr>
    <td width="10" style="font-size:1px">&nbsp;</td>
    <td>
      <a href="{linkUrl page='Denkmal_Page_SignUp' invite=$userInvite->getKey()}" style="color: #ffffff">{translate 'Account Erstellen'}</a>
    </td>
    <td width="10" style="font-size:1px">&nbsp;</td>
  </tr>
</table>

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
