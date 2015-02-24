{if $viewer || $venue->getCoordinates() || $messageList->getCount()}
  <div class="head clearfix">
    {if $viewer}
      {button_link page='Denkmal_Page_Now' icon='chat-flash' label={translate 'Was loift?!'}}
    {/if}
    {if $venue->getCoordinates()}
      <a href="https://maps.google.com/?q={$venue->getCoordinates()->getLatitude()},{$venue->getCoordinates()->getLongitude()}" class="location button button-transparent hasLabel hasIcon" target="_blank">
        <span class="icon icon-location"></span>
        <span class="label">{translate 'Karte'}</span>
      </a>
    {/if}
  </div>
  {if $messageList->getCount()}
    {component name='Denkmal_Component_MessageList_Venue' venue=$venue}
  {/if}
{else}
  <div class="noContent">
    {translate 'Keine weiteren Informationen'}
  </div>
{/if}
