{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}
{block name='content-main'}
  <div class="swipeCarousel beforeload">
    <div class="underTheHood">
      <div class="credits">
        <p class="separator">------ {translate 'Sponsor'} ------</p>
        <div class="logo cargomedia"></div>
        <p class="hire">{translate 'We\'re hiring!'}</p>
      </div>
      <div class="labels">
        <div class="logo denkmal"></div>
        <div class="logo madeinbasel"></div>
      </div>
      <div class="cat">
        <span class="logo cat"></span>
      </div>
    </div>
    {if $menu->getEntries()}
      <ul class="dateList">
        {foreach $menu->getEntries() as $entry}
          {$menuDate = $entry->getLabel()}
          <li class="date {if $menuDate == $date}active{/if}" data-title="{date_weekday date=$menuDate} - {$render->getSiteName()}" data-url="{linkUrl page=$entry->getPage() params=$entry->getParams()}" data-menu-entry-hash="{$entry->getHash()}">
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
