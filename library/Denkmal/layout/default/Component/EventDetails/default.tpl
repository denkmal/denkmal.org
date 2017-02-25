<div class="header">
  {contentPlaceholder width=8 height=5 stretch=true}
  {if $venue->getCoordinates()}
    <img src="{googlemaps_img coordinates=$venue->getCoordinates() width=640 height=400}">
  {else}
    // some placeholder
  {/if}
  {/contentPlaceholder}
  {button_link class='button-location' href=$mapLink target='_blank' icon='location' label={translate 'Google Maps'}}
</div>
{component name='Denkmal_Component_Event' event=$event}
<div class="more">
  {if $venue->getUrl()}
    <div>
      {button_link theme='transparent' href=$venue->getUrl() target='_blank' icon='pop-out' label=$venue->getName()}
    </div>
  {/if}
  {foreach $event->getLinks() as $link}
    <div>
      {button_link theme='transparent' href=$link->getUrl() target='_blank' icon='pop-out' label=$link->getLabel()}
    </div>
  {/foreach}
</div>



