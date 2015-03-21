{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {translate 'Erstelle jetzt deinen Denkmal Hipster Account!'}
  {form name='Denkmal_Form_User' inviteKey=$userInvite->getKey()}
  {formField name='email' placeholder={translate 'E-Mail'}}
  {formField name='username' placeholder={translate 'Username'}}
  {formField name='password' placeholder={translate 'Passwort'}}
  {formAction action='Create' label={translate 'Anmelden'}}
  {/form}
{/block}
