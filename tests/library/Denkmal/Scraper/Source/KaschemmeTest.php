<?php

class Denkmal_Scraper_Source_KaschemmeTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/kaschemme.html');

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Kaschemme')->setMethods(array('_addEventAndVenue'))->getMock();
        $scraper->expects($this->exactly(11))->method('_addEventAndVenue');
        $scraper->expects($this->at(0))->method('_addEventAndVenue')->with(
            'Kaschemme',
            new Denkmal_Scraper_Description('FC Basel 1893 - Liverpool FC'),
            new DateTime('2014-10-01 18:00:00')
        );
        $scraper->expects($this->at(1))->method('_addEventAndVenue')->with(
            'Kaschemme',
            new Denkmal_Scraper_Description('Kaschemme SKANK w/ Echolt'),
            new DateTime('2014-10-03 22:00:00')
        );
        $scraper->expects($this->at(2))->method('_addEventAndVenue')->with(
            'Kaschemme',
            new Denkmal_Scraper_Description('Gestern Nacht in der Kaschemme w/ Herzschwester & Thom Nagy'),
            new DateTime('2014-10-04 22:00:00')
        );

        /** @var Denkmal_Scraper_Source_Kaschemme $scraper */
        $scraper->processPage($html);
    }
}



/**
 * <div class="project_content">
Mittwoch 01.10.2014 /// FC Basel 1893 - Liverpool FC /// 18h<br />
......................................................................................................<br />
Freitag 03.10.2014 /// Kaschemme SKANK w/ Echolt /// 22h<br />
......................................................................................................<br />
Samstag 04.10.2014 /// Gestern Nacht in der Kaschemme w/ Herzschwester & Thom Nagy 22h<br />
......................................................................................................<br />
Sonntag 05.10.2014 /// Ebo Taylor LIVE! w/ Konzeptlos /// 18h<br />
......................................................................................................<br />
Freitag 10.10.2014 /// WeMakeIt "Exclusiv Party" w/ Dj Mixwell, Konzeptlos & Goldfinger Brothers (Nur mit Einladung oder Wemakeit Sponsoring!!!) 20h<br />
......................................................................................................<br />
Samstag 11.10.2014 /// Kaschemme Cypher Hostet by Kalmoo w/ Levo Rimed (K.W.A.T.) Dj's: Giddla (TNN) & DJ ALK aka Dimes /// 22h<br />
......................................................................................................<br />
Freitag 17.10.2014 /// Xplcit Contents After Party /// 20h<br />
Samstag 18.10.2014 ///Love Tempo w/ Kejeblos (Phantom Island Records, Zürich), Hotmail, Akay, Neevo /// 22h<br />
......................................................................................................<br />
Freitag 24.10.2014 /// ça Claque Label Night w/ Nunu (Strasbourg, FR), Lord Soft, B.O.M., Larry King, Goldfinger Brothers 22h<br />
......................................................................................................<br />
Samstag 25.10.2014 /// Beatklinik pres. Calibro 35 (IT) LIVE /// 22h<br />
......................................................................................................<br />
Freitag 31.10.2014 /// Akiwawa w/ Dj Format (UK), Pun & Rainer /// 22h<br />

 */
