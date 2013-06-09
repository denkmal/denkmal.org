{if !empty($menu_entries)}
	<ul class="{$menu_class}">
		{foreach from=$menu_entries item=entry}
			<li class="{$entry->getPageName()} {$entry->getClass()} {if $entry->isActive($activePath, $activeParams)}active{/if} navButton" data-menu-entry-hash="{$entry->getHash()}">
				<a href="{linkUrl page=$entry->getPage() params=$entry->getParams()}">
					{if $entry->getIcon()}<span class="icon icon-{$entry->getIcon()}"></span>{/if}<span class="label">{translate $entry->getLabel()}</span>
				</a>
			</li>
		{/foreach}
	</ul>
{/if}
