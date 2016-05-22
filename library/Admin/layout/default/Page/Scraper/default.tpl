{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <h2>{translate 'Processed Events'}</h2>
  {component name='CM_Component_Graph' series=$graphSeriesEvents}

  <h2>{translate 'Error'}</h2>
  {component name='CM_Component_Graph' series=$graphSeriesErrors}

  <ul class="errorList dataTable">
    {foreach $resultErrorList as $result}
      <li>
        <div class="toggleNext">
          <span class="date">{date time=$result->getCreated()->getTimestamp()}</span>
          <span class="scraper">{$result->getScraperSource()->getName()|escape}</span>
          <span class="message">{$result->getError()->getMessage()|escape}</span>
        </div>
        <div class="toggleNext-content">
          <pre class="trace">{$errorFormatter->format($result->getError())|escape}</pre>
        </div>
      </li>
    {/foreach}
  </ul>
{/block}
