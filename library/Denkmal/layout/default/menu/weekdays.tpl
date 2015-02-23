{if !empty($menu_entries)}
  {strip}
    <ul class="{$menu_class}">
      {foreach $menu_entries as $entry}
        <li class="{$entry->getPageName()} {$entry->getClass()} {if $entry->isActive($activePath, $activeParams)}active{/if}" data-menu-entry-hash="{$entry->getHash()}">
          <a class="navButton" href="{linkUrl page=$entry->getPageName() params=$entry->getParams()}">
            {if $entry->getIcon()}<span class="icon icon-{$entry->getIcon()}"></span>{/if}
            <span class="label">{date_weekday date=$entry->getLabel()}</span>
          </a>
        </li>
      {/foreach}
    </ul>
  {/strip}
{/if}
