{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <ul class="userList">
    {foreach $userList as $user}
      <li class="userList-item">
        {$user->getUsername()}
      </li>
    {/foreach}
  </ul>
  {paging paging=$userList}
{/block}
