{if $eventList->getCount()}
  {block name='headline'}{/block}
  <ul class="eventList">
    {foreach $eventList as $event}
      <li class="eventList-item">
        {component name='Admin_Component_Event' event=$event}
      </li>
    {/foreach}
  </ul>
  {paging paging=$eventList}
{/if}
