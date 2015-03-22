{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <div class="addNew">
    <div class="toggleNext">{translate 'Hinzufügen'}<span class="icon-plus"></span></div>
    <div class="toggleNext-content">
      {form name='Admin_Form_UserInvite'}
      {formField name='email' label={translate 'E-Mail'}}
      {formField name='expires' label={translate 'Verfall'}}
      {formField name='sendEmail' text={translate 'Einladung schicken'}}
      {formAction action='Create' label={translate 'Hinzufügen'}}
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
