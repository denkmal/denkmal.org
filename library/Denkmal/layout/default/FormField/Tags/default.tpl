{strip}
  <ul class="tagList">
    <li class="tag tag-special" data-type="text">
      <a href="javascript:;" class="toggleSpecial">
        <div class="tag-image">{resourceFileContent path='img/icon/text.svg'}</div>
      </a>
    </li>
    {if Denkmal_Form_Message::getImageAllowed($viewer)}
      <li class="tag tag-special" data-type="image">
        <a href="javascript:;" class="toggleSpecial">
          <div class="tag-image">{resourceFileContent path='img/icon/photo.svg'}</div>
        </a>
      </li>
    {/if}
    {foreach $tagListAvailable as $tag}
      <li class="tag {if in_array($tag->getId(), $tagIdList)}active{/if}" data-id="{$tag->getId()|escape}">
        <a href="javascript:;" class="toggleTag">
          {img class='tag-image' path="tag/{$tag->getLabel()}.svg"}
        </a>
      </li>
    {/foreach}
  </ul>
{/strip}

{if null !== $options.cardinality}
  <p class="cardinality-info">{translate '{$count} Sticker verfügbar' count="<span class='cardinality-left'>{$options.cardinality}</span>"}</p>
{/if}

<input type="hidden" name="{$name}" id="{$inputId}">
