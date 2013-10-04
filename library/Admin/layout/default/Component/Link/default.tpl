<div class="venue-content toggleNext">
	{$link->getLabel()|escape}
	<a target="_blank" href="{$link->getUrl()|escape}">{$link->getUrl()|escape}</a>
	{if !$link->getAutomatic()}[manual]{/if}
</div>
<div class="venue-edit toggleNext-content">
	{form name='Admin_Form_Link' link=$link}
		{formField name='label' label={translate 'label'}}
		{formField name='url' label={translate 'url'}}
		{formField name='automatic' label={translate 'automatic'}}

		{formAction action='Save' label={translate 'Speichern'} alternatives="
			{button action='Delete' label={translate 'Löschen'} theme='danger' event='clickConfirmed'}
		"}
	{/form}
</div>
