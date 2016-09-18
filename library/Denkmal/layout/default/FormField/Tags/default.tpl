{strip}
  <ul class="tagList">
    <li class="tag tag-special" data-type="text">
      <a href="javascript:;" class="toggleSpecial">
        <span class="tag-image">{resourceFileContent path='img/icon/text.svg'}</span>
      </a>
    </li>
    {if Denkmal_Form_Message::getImageAllowed($viewer)}
      <li class="tag tag-special" data-type="image">
        <a href="javascript:;" class="toggleSpecial">
          <span class="tag-image">{resourceFileContent path='img/icon/photo.svg'}</span>
        </a>
      </li>
    {/if}
    {foreach $tagListAvailable as $tag}
      <li class="tag" data-id="{$tag->getId()|escape}">
        <a href="javascript:;" class="toggleTag">
          <span class="tag-image">{resourceFileContent path="img/tag/{$tag->getLabel()}.svg"}</span>
        </a>
        <div class="count"></div>
      </li>
    {/foreach}
  </ul>
{/strip}

{if null !== $options.cardinality}
  <p class="cardinality-info">{translate '{$count} Stickers available' count="<span class='cardinality-left'>{$options.cardinality}</span>"}</p>
{/if}
