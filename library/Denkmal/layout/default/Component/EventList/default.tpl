<time class="currentDate"><span class="weekday">{date_weekday date=$date}</span>{date time=$date->getTimestamp()}</time>

{if $events->getCount()}
  <ul class="eventList">
    {foreach $events as $event}
      <li>
        {component name='Denkmal_Component_Event' event=$event}
      </li>
    {/foreach}
  </ul>
{else}
  <div class="noContent">
    <p>{button_link page="Denkmal_Page_Add" theme="highlight" icon="plus" label="{translate 'Add event'}"}</p>
  </div>
{/if}
<div class="socialFollow">
  <a class="link hasIcon" href="https://twitter.com/denkmal_org" target="_blank" title="{translate 'Follow us on Twitter'}">
    <span class="icon icon-twitter"></span>
  </a>
  <a class="link hasIcon" href="https://www.facebook.com/denkmal.org" target="_blank" title="{translate 'Find us on Facebook'}">
    <span class="icon icon-facebook"></span>
  </a>
</div>

