{if count($events)}
  <ul class="eventList">
    {foreach $events as $event}
      <li class="clickFeedback showEventDetails">
        {component name='Denkmal_Component_Event' template='details' event=$event venueBookmarks=$venueBookmarks}
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
  {button_link theme='transparent' page='Denkmal_Page_Add' label="+{translate 'Event'}"}
  {if $twitterAccount}
    {button_link theme='transparent' icon='twitter' title='Twitter' href="https://twitter.com/{$twitterAccount}" target="_blank"}
  {/if}
  {if $facebookAccount}
    {button_link theme='transparent' icon='facebook' title='Facebook' href="https://www.facebook.com/{$facebookAccount}" target="_blank"}
  {/if}
</footer>
