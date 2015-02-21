{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}

  <ul class="userList">
    {foreach $userList as $user}
      <li class="userList-item">
        {component name='Admin_Component_User' user=$user}
      </li>
    {/foreach}
  </ul>
  {paging paging=$userList}
{/block}
