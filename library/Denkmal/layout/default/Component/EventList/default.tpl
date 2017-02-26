<div class="eventListMeta">{$region->getName()|escape} -
  <time>{date_full date=$date timeZone=$date->getTimeZone()}</time>
</div>

{if count($events)}
  <ul class="eventList">
    {foreach $events as $event}
      <li>
        {component name='Denkmal_Component_Event' event=$event venueBookmarks=$venueBookmarks}
        {component name='Denkmal_Component_EventDetails' event=$event}
      </li>
    {/foreach}
  </ul>
{else}
  <div class="noContent">
    {button_link page="Denkmal_Page_Add" theme="highlight" icon="plus" label="{translate 'Add Event'}"}
  </div>
{/if}

<footer class="footer">
  {button_link theme='transparent' icon='location' label={$region->getName()|escape} page='Denkmal_Page_City'}
  {if $twitterAccount}
    {button_link theme='transparent' label='Twitter' href="https://twitter.com/{$twitterAccount}" target="_blank"}
  {/if}
  {if $facebookAccount}
    {button_link theme='transparent' label='Facebook' href="https://www.facebook.com/{$facebookAccount}" target="_blank"}
  {/if}
</footer>
