{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}

{block name='content-main'}
  {if $showBannerGrazLaunch}
    <div class="banner">
      <div class="banner-inner">
        {contentPlaceholder width=4 height=1 stretch=true}
          <a href="{linkUrl page='Denkmal_Page_Events' date='2016-10-14'}">
            {img path='banner-graz.svg'}
          </a>
        {/contentPlaceholder}
        {button_link class='dismissBanner' theme='transparent' icon='close'}
      </div>
    </div>
  {/if}
  <div class="swipeCarousel">
    <ul class="dateList">
      {foreach $menu->getEntries($render->getEnvironment()) as $entry}
        {$menuDate = $entry->getLabel()}
        {$entryParams = $entry->getParams()}
        <li class="date {if $menuDate == $date}active{/if}" data-title="{date_weekday date=$menuDate timeZone=$menuDate->getTimeZone()} - {$render->getSiteName()}" data-date="{$entryParams.date}" data-url="{linkUrl page=$entry->getPageName() params=$entry->getParams()}" data-menu-hash="{$entry->getHash()}">
          <div class="hideScrollBar scrollable">
            {component name='Denkmal_Component_EventList' region=$region date=$menuDate}
          </div>
        </li>
      {/foreach}
    </ul>
  </div>
{/block}
