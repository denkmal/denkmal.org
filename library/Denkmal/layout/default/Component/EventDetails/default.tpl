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
  {strip}
    <div class="moreList">
      {if $venue->getUrl()}
        <div class="moreItem">
          <a href="{$venue->getUrl()|escape}" target="_blank">
            <div class="moreItem-icon">
              <div class="icon icon-network"></div>
            </div>
            <div class="moreItem-content">
              <span>{translate 'Venue Website'}</span>
            </div>
          </a>
        </div>
      {/if}
      {foreach $event->getLinks() as $link}
        <div class="moreItem">
          <a href="{$link->getUrl()|escape}" target="_blank">
            <div class="moreItem-icon">
              <div class="icon icon-network"></div>
            </div>
            <div class="moreItem-content">
              <span>{$link->getLabel()|escape}</span>
            </div>
          </a>
        </div>
      {/foreach}
      {if $song = $event->getSong()}
        <div class="moreItem">
          <a href="javascript:;" class="playSong">
            <div class="moreItem-icon">
              {component name="Denkmal_Component_SongPlayerButton" song=$song}
            </div>
            <div class="moreItem-content">
              <span>{$song->getLabel()|escape}</span>
            </div>
          </a>
        </div>
      {/if}
    </div>
  {/strip}
  <a href="{linkUrl page='Denkmal_Page_Events' date=$event->getFrom()->format('Y-n-j')}" class="showEventList" style="display:none;"></a>
{/block}
