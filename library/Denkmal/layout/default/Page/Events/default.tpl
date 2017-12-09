{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}

{block name='content-main'}
  <div class="banner banner-nachfolge">
    <div class="banner-inner">
      <a href="https://goo.gl/forms/9XnuJ3BVMRZZt3Sf1" target="_blank">
        <div class="text">
          Das Team hinter Denkmal.org sucht eine Nachfolge!<br>
          <span class="call-to-action">Mehr erfahren.</span>
        </div>
        <div class="bild">
          {img path='denkmal-nachfolge.png' class="kleine-eule"}
        </div>
      </a>
      {button_link class='dismissBanner' theme='transparent' icon='close'}
    </div>
  </div>
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
