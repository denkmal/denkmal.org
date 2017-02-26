<div class="header">
  {contentPlaceholder width=8 height=5 stretch=true}
  {if $venue->getCoordinates()}
    <img class="header-map" src="{googlemaps_img coordinates=$venue->getCoordinates() width=640 height=400}">
  {else}
    {img path='map-placeholder.svg'}
  {/if}
  {/contentPlaceholder}
  {if $venue->getCoordinates()}
    {button_link class='button-location' href=$mapLink target='_blank' icon='location' label={translate 'Google Maps'}}
  {/if}
</div>
{component name='Denkmal_Component_Event' event=$event}
<div class="more">
  <div class="more-links">
    {if $venue->getUrl()}
      <div>
        {button_link theme='transparent' href=$venue->getUrl() target='_blank' icon='pop-out' iconPosition="right" label=$venue->getName()}
      </div>
    {/if}
    {foreach $event->getLinks() as $link}
      <div>
        {button_link theme='transparent' href=$link->getUrl() target='_blank' icon='pop-out' iconPosition="right" label=$link->getLabel()}
      </div>
    {/foreach}
  </div>
  {if $song = $event->getSong()}
    <div class="more-song">
      <h4><span class="music">♫</span> {$song->getLabel()}</h4>
      {component name="Denkmal_Component_SongPlayerButton" song=$song}
    </div>
  {/if}
</div>



