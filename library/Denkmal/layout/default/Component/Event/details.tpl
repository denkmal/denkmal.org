<div class="header">
  {contentPlaceholder width=8 height=5 stretch=true}
  {if $venue->getCoordinates()}
    <img class="header-map" data-src="{googlemaps_img coordinates=$venue->getCoordinates() width=640 height=400}">
  {else}
    {img path='map-placeholder.svg'}
  {/if}
  {/contentPlaceholder}
  {if $venue->getCoordinates()}
    {button_link class='button-location' href=$mapLink target='_blank' icon='location' label={translate 'Google Maps'}}
  {/if}
</div>
<div class="event" {if $event->getStarred()}data-promoted{/if}>
  <div class="venue-bookmark {if $isPersistent}toggleVenueBookmark{/if}" {if $isPersistent}data-venue-id="{$venue->getId()}"{/if} {if $isBookmarked}data-bookmarked{/if}>
    {resourceFileContent path='img/star.svg'}
  </div>
  <div class="event-description">
    <div class="venue nowrap">
      {$venue->getName()|escape}
    </div>
    <div class="details">
      {eventtext event=$event}{if $event->getSong()}<span class="music">♫</span>{/if}
    </div>
  </div>
  <div class="event-context">
    <time class="date">{date_full date=$event->getFrom() timeZone=$event->getTimeZone()}</time>
    <time class="time">
      {event_time event=$event}
    </time>
    {*<div class="share">*}
    {*<span class="icon icon-share"></span>*}
    {*</div>*}
  </div>
</div>
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
