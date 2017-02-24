{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {form name='Denkmal_Form_User' inviteKey=$userInvite->getKey()}
  {formField name='email' placeholder={translate 'Email'}}
  {formField name='username' placeholder={translate 'Username'}}
  {formField name='password' placeholder={translate 'Password'}}
  {formAction action='Create' label={translate 'Create'}}
  {/form}
{/block}
