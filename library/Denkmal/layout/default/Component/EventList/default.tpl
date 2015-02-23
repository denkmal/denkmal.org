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
    <p>{button_link page="Denkmal_Page_Add" theme="highlight" icon="plus" label="{translate 'Event hinzufügen'}"}</p>
  </div>
{/if}
<div class="socialFollow">
  {link icon='twitter' href='https://twitter.com/denkmal_org' title={translate 'Follow us on Twitter'}}
  {link icon='facebook' href='https://www.facebook.com/denkmal.org' title={translate 'Find us on Facebook'}}
</div>

