{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}

{block name='content-main'}
  {if $region->getSlug() == 'basel'}
    <div class="banner banner-denkmalmit">
      <div class="banner-inner">
        <a href="https://denkmalmit.org" target="_blank">
          <div class="text">
            <strong>Es geht weiter!</strong><br> Mit deiner Unterstützung auf <span class="call-to-action">Denkmalmit</span> ❤️
          </div>
          <div class="bild">
            {img path='denkmal-nachfolge.png' class="kleine-eule"}
          </div>
        </a>
        {button_link class='dismissBanner' theme='transparent' icon='close'}
      </div>
    </div>
  {/if}
  <div class="swipeCarousel">
    <ul class="dateList">
      {foreach $menu->getEntries($render->getEnvironment()) as $entry}
        {$menuDate = $entry->getLabel()}
        {$entryParams = $entry->getParams()}
        <li class="dateList-item {if $menuDate == $date}active{/if}" data-title="{date_weekday date=$menuDate timeZone=$menuDate->getTimeZone()} - {$render->getSiteName()}" data-date="{$entryParams.date}" data-url="{linkUrl page=$entry->getPageName() params=$entry->getParams()}" data-menu-hash="{$entry->getHash()}">
          <div class="hideScrollBar scrollable">
            {component name='Denkmal_Component_EventList' region=$region date=$menuDate venueBookmarks=$venueBookmarks}
          </div>
        </li>
      {/foreach}
    </ul>
  </div>
{/block}
