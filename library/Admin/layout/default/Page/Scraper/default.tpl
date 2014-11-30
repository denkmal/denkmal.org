{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <h2>{translate 'Verarbeitete Veranstaltungen'}</h2>
  {component name='CM_Component_Graph' series=$graphSeriesEvents}

  <h2>{translate 'Fehler'}</h2>
  {component name='CM_Component_Graph' series=$graphSeriesErrors}
{/block}
