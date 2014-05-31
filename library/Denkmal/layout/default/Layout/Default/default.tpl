{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name="before-html"}
<!--
                           You like to see what's under the hood?


                                     RRRR, RRRRV =RRRR
                                    iRRRRR RRRRR RRRRR;
                                     RRRR: RRRRX +RRRR
                                      .,     ,     ..
                                     VRRX  =RRR:  RRRI
                                    +RRRRR RRRRR RRRRR:
                                    ,RRRRV RRRRR RRRRR.
                                     .IV:   iV+   ;VI
                                     ,VV=   IXt   +XY.
                                    :RRRRX RRRRR RRRRR.
                                    =RRRRR RRRRR RRRRR:
                                     IRRX  ;RRR,  RRRt


                                                                      R  R
            ..    ...            ..     ..      ..  ..      ,      ,  R       ..
          ,RRRR, ,RRR  ,RRRRI .RRRRV  RRRRR:  RV =RR:.Ri  RI IR  XX :RR  R  .t :R
          RR     RR,R; ,Rt.RX RR     RR   RR  R   R.  ;X +X   R, R    R  R      X,
          RR     RX:RR ,RRRX  RR RRR RR   RR  R   R   ;X tX     .R    R  R  Ri  R,
          RRRiR RRRRRR:,Rt=RV RRRiRR =RRiRRI  R   R   ;X  R      R.  RR  R  R   R,
            YRt YY   YY,Y+ tYt  YRY:   tRY    i   i   ,+   =RY;   +Rt i  i  .VY.;.


                               Large Scale Web Development


                                   --- We're Hiring ---
                                    www.cargomedia.ch
-->
{/block}
{block name='tileColor'}#3CC94D{/block}

{block name='body'}
  <header id="header">
    <div class="sheet">
      {block name='header'}
        {component name='Denkmal_Component_HeaderBar'}
      {/block}
    </div>
  </header>
  <section id="middle" class="sheet">
    {$renderAdapter->fetchPage()}
  </section>
  {component name='Denkmal_Component_SongPlayer'}
{/block}
