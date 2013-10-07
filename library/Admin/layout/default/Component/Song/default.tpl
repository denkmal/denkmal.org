<div class="song-content toggleNext">
	{$song->getLabel()|escape}
</div>
<div class="song-edit toggleNext-content">
	{form name='Admin_Form_Song' song=$song}
		{formField name='label' label={translate 'Name'}}

		{formAction action='Save' label={translate 'Speichern'} alternatives="
			{button action='Delete' label={translate 'Löschen'} theme='danger' event='clickConfirmed'}
		"}
	{/form}
</div>
