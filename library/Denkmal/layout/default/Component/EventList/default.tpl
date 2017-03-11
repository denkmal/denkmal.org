{if count($events)}
  <ul class="eventList">
    {foreach $events as $event}
      <li class="clickFeedback showEventDetails" data-href="{linkUrl page='Denkmal_Page_Events' date=$date->format('Y-n-j') event=$event->getId()}">
        {component name='Denkmal_Component_Event' event=$event venueBookmarks=$venueBookmarks includeDetails=true}
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
  {button_link theme='transparent' page='Denkmal_Page_Add' label={translate 'Contact'}}
  {if $twitterAccount}
    {button_link theme='transparent' icon='twitter' title='Twitter' href="https://twitter.com/{$twitterAccount}" target="_blank"}
  {/if}
  {if $facebookAccount}
    {button_link theme='transparent' icon='facebook' title='Facebook' href="https://www.facebook.com/{$facebookAccount}" target="_blank"}
  {/if}
</footer>
