{if $viewer || $venue->getCoordinates()}
  <div class="head clearfix">
    {if $viewer}
      {if !$messageList->getCount()}
        {button_link page='Denkmal_Page_Now' venue=$venue->getId() icon='chat-flash' label={translate 'Schreib etwas!'} theme='transparent'}
      {/if}
    {/if}

    {if $venue->getCoordinates()}
      <a href="https://maps.google.com/?q={$venue->getCoordinates()->getLatitude()},{$venue->getCoordinates()->getLongitude()}" class="location button button-transparent hasLabel hasIcon" target="_blank">
        <span class="icon icon-location"></span>
        <span class="label">{translate 'Karte'}</span>
      </a>
    {/if}
  </div>
  {if $messageList->getCount()}
    {component name='Denkmal_Component_MessageList_Venue' venue=$venue count=3}
  {/if}

  {if $viewer}
    {if $messageList->getCount()}
      <div class="action-chat">
        {button_link page='Denkmal_Page_Now' venue=$venue->getId() icon='chat-flash' label={translate 'Weiterlesen…'} theme='transparent'}
      </div>
    {/if}
  {/if}

{else}
  <div class="noContent">
    {translate 'Keine weiteren Informationen'}
  </div>
{/if}
