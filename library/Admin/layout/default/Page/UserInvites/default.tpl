{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <div class="addNew">
    <div class="toggleNext">{translate 'Add'}<span class="icon-plus"></span></div>
    <div class="toggleNext-content">
      {form name='Admin_Form_UserInvite'}
      {formField name='email' label={translate 'Email'}}
      {formField name='expires' label={translate 'Expiration'}}
      {formField name='sendEmail' text={translate 'Send invite'}}
      {formAction action='Create' label={translate 'Add'}}
      {/form}
    </div>
  </div>
  <ul class="userInviteList">
    {foreach $userInviteList as $userInvite}
      <li class="userInviteList-item">
        {component name='Admin_Component_UserInvite' userInvite=$userInvite}
      </li>
    {/foreach}
  </ul>
  {paging paging=$userInviteList}
{/block}
