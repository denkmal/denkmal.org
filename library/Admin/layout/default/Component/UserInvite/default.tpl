<div class="toggleNext">{if $userInvite->getEmail()}{$userInvite->getEmail()|escape} {/if}by {$userInvite->getInviter()->getDisplayName()|escape}</div>
<div class="toggleNext-content">
  {form name='Admin_Form_UserInvite' userInvite=$userInvite}
  {formField name='email' label={translate 'Email'}}
  {formField name='expires' label={translate 'Expiration'}}
  {formAction action='Save' label={translate 'Save'} alternatives="
    <a href='{$render->getUrlPage('Denkmal_Page_SignUp', ['invite' => $userInvite->getKey()], $linkSite)|escape}'>{translate 'Invitation Link'}</a>
  "}
  {/form}
</div>
