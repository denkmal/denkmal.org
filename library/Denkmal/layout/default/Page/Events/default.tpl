{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}

{block name='content-main'}
  <div class="swipeCarousel beforeload">
    <div class="underTheHood">
      <div class="underTheHood-left">
        <p class="separator">------ {translate 'With help'} ------</p>
        <a href="http://www.cargomedia.ch" class="logo cargomedia" title="Cargo Media AG"></a>
        <p class="hire">{translate 'We\'re hiring!'}</p>
        <p class="separator">------ {translate 'For Nerds'} ------</p>
        <p><a href="https://github.com/denkmal/denkmal.org">Fork on Github</a></p>
        <p class="separator">------ {translate 'With love'} ------</p>
        <a href="http://www.madeinbasel.org" class="logo madeinbasel"></a>
      </div>
      <div class="underTheHood-right">
        <span class="logo cat"></span>
      </div>
    </div>
    {if $menu->getEntries()}
      <ul class="dateList">
        {foreach $menu->getEntries() as $entry}
          {$menuDate = $entry->getLabel()}
          {$entryParams = $entry->getParams()}
          <li class="date {if $menuDate == $date}active{/if}" data-title="{date_weekday date=$menuDate} - {$render->getSiteName()}" data-date="{$entryParams.date}" data-url="{linkUrl page=$entry->getPageName() params=$entry->getParams()}" data-menu-hash="{$entry->getHash()}">
            <div class="hideScrollBar scrollable">
              {component name='Denkmal_Component_EventList' date=$menuDate}
            </div>
          </li>
        {/foreach}
      </ul>
    {else}
      <div class="noContent">
        <h3>{translate 'Something is wrong!'}</h3>
      </div>
    {/if}
  </div>
{/block}
