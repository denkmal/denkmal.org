{extends file=$render->getLayoutPath('Component/Event/default.tpl')}

{block name='event-before'}
  <div class="header">
    {contentPlaceholder width=8 height=5 stretch=true}
    {if $mapLink && $venue->getCoordinates()}
      <img data-src="{googlemaps_img coordinates=$venue->getCoordinates() styleFile='google-maps-styles.json'}">
    {else}
      {img path='map-placeholder.svg'}
    {/if}
    {/contentPlaceholder}
    {if $mapLink}
      {button_link class='button-location' href=$mapLink target='_blank' icon='pop-out' iconPosition='right' label={translate 'Google Maps'}}
    {/if}
  </div>
{/block}

{block name='event-after'}
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
    {if $event->getStarred()}
      <div class="more-promoted">
        <span class="icon">♥</span>{translate 'Event recommended by {$siteName}' siteName=$render->getSiteName()}
      </div>
    {/if}
  </div>
  <a href="{linkUrl page='Denkmal_Page_Events' date=$event->getFrom()->format('Y-n-j')}" class="showEventList" style="display:none;"></a>
{/block}
