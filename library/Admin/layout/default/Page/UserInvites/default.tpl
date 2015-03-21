{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <ul class="userInviteList">
    {foreach $userInviteList as $userInvite}
      <li class="userInviteList-item">
        {component name='Admin_Component_UserInvite' userInvite=$userInvite}
      </li>
    {/foreach}
  </ul>
  {paging paging=$userInviteList}
{/block}
