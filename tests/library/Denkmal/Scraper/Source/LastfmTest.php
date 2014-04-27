<?php

class Denkmal_Scraper_Source_LastfmTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/lastfm.xml');

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Lastfm')->setMethods(array('_addEventAndVenue'))->getMock();
        $scraper->expects($this->exactly(50))->method('_addEventAndVenue');
        $scraper->expects($this->at(0))->method('_addEventAndVenue')->with(
            'Z7 Konzertfabrik Pratteln',
            new Denkmal_Scraper_Description('Sonata Arctica', 'Sonata Arctica', new Denkmal_Scraper_Genres('symphonic metal, metal, power metal, melodic metal')),
            new DateTime('2014-04-27 20:00:00')
        );
        $scraper->expects($this->at(1))->method('_addEventAndVenue')->with(
            'Z7 Konzertfabrik Pratteln',
            new Denkmal_Scraper_Description('The Flower Kings, Karmakanic', 'Also includes Prog Rock Royalty Supersession 2014', new Denkmal_Scraper_Genres('progressive rock, progressive metal, symphonic prog')),
            new DateTime('2014-04-28 20:00:00')
        );
        $scraper->expects($this->at(3))->method('_addEventAndVenue')->with(
            'Hirscheneck',
            new Denkmal_Scraper_Description(null, 'Baby Jail', new Denkmal_Scraper_Genres('mundart, switzerland, swiss, zurich')),
            new DateTime('2014-05-01 20:00:00')
        );
        $scraper->expects($this->at(4))->method('_addEventAndVenue')->with(
            'Kaserne Basel',
            new Denkmal_Scraper_Description('Vieux Farka Touré', 'Der grosse, stilbildende Gitarrist Vieux Farka Touré ist nicht erst seit seinem Auftritt an derEröffnung der Fussball-WM in Südafrika 2010 in aller Munde. Der Sohn des berühmten malischenMusikers Ali Farka Touré wird seit Jahren der «Jimi Hendrix Afrikas» genannt. Der Sänger undGitarrist studierte in Bamako Percussion und Gitarre. Als musikalische Haupteinflüsse nennt erneben seinem Vater auch John Lee Hooker, B.B.King und Salif Keita. Vieux Farka Touré schaffte deninternationalen Durchbruch 2006 mit dem ersten von Eric Herman produzierten Album «VieuxFarka Touré». Touré überzeugt mit einer Mischung aus Afro-Blues, Reggae und den musikalischenWurzeln Malis. Er verbindet auf kongeniale Art und Weise westliche Einflüsse mit afrikanischerMusiktradition, die E-Gitarre mit dem Kora-Spiel, Afrorhythmen mit Blues und Funk. Seine Showsentwickeln sich live mit viel Improvisationsfreude und Spiellust zu einer trance-artigen Jam-Session.In Basel stellt er erstmals sein neues Album «Mon Pays» live in der Schweiz vor.',
                new Denkmal_Scraper_Genres('world, african, mali, desert blues')),
            new DateTime('2014-05-02 20:00:00')
        );
        /** @var Denkmal_Scraper_Source_Lastfm $scraper */

        $scraper->processPageDate($html);
    }
}
