<div class="head clearfix">
  {button_link page='Denkmal_Page_Now' icon='chat-flash' label={translate 'Was loift?!'} theme='highlight'}
  {if $venue->getCoordinates()}
    <a href="https://maps.google.com/?q={$venue->getCoordinates()->getLatitude()},{$venue->getCoordinates()->getLongitude()}" class="location button button-default hasLabel hasIcon" target="_blank">
      <span class="icon icon-location"></span>
      <span class="label">{translate 'Navigieren'}</span>
    </a>
  {/if}
</div>

{component name='Denkmal_Component_MessageList_Venue' venue=$venue}
